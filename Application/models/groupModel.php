<?php
class groupModel extends DB
{
    /* group */
    function getGroupByID($id){

        $sql = "SELECT * FROM nhom
                WHERE ma_nhom = ? AND hoatdong = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $group = array();
        while ($row = mysqli_fetch_assoc($result)) {;
            $group['g_id'] = $row['ma_nhom'];
            $group['gv_id'] = $row['ma_gv'];
            $group['name'] = $row['tennhom'];
        }

        $stmt->close();
        return $group;
    }

    function getGroupByUser($uid, $page, $limit){ 
        $offset = ($page - 1) * $limit;
        $stmt = null;

        if($uid == null){
            $sql = "SELECT * FROM nhom
                    WHERE hoatdong = 1 LIMIT ?, ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ii', $offset, $limit);
        }else{
            $char = substr($uid,0,2);
            if($char == 'SV'){
                $sql = "SELECT * FROM nhom 
                        INNER JOIN chitietnhom on nhom.ma_nhom = chitietnhom.ma_nhom
                        WHERE ma_sv = ? AND hoatdong = 1 LIMIT ?, ?";
            }else{
                $sql = "SELECT * FROM nhom
                WHERE ma_gv = ? AND hoatdong = 1 LIMIT ?, ?";
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sii', $uid, $offset, $limit);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $listGroup = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $group = array();
            $group['g_id'] = $row['ma_nhom'];
            $group['gv_id'] = $row['ma_gv'];
            $group['name'] = $row['tennhom'];
            array_push($listGroup, $group);
        }
        
        $stmt->close();
        $this->conn->close();
        return $listGroup;
    }

    function add($gv_id, $name){

        $stmt = null;
        // insert group table
        $sql = "INSERT INTO nhom (ma_gv, tennhom) 
        VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $gv_id, $name);
        $rs = true;
        if(!$stmt->execute()){ 
            $rs = false;
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function update($g_id, $name){
        $rs = ['update'=>false,
               'message' => '',
               'cod' => 500];

        // update group table
        $sql = "UPDATE nhom 
                SET tennhom = ?
                WHERE ma_nhom = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $name, $g_id);
        if($stmt->execute()){ 
            $rs = ['update'=>true,
                   'message' => '',
                   'cod' => 200];
        }
       
        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function remove($id){
        $rs = ['delete'=>false,
               'message' => '',
               'cod' => 500];

        $sql = "UPDATE nhom 
                SET hoatdong = 0
                WHERE ma_nhom = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        if($stmt->execute()){
            $rs = ['delete'=>true,
                   'message' => '',
                   'cod' => 200];
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }


    /* member */
    function getMember($g_id){
        $sql = "SELECT taikhoan.*, sinhvien.*, tennganh, tenkhoahoc FROM sinhvien 
                INNER JOIN taikhoan on taikhoan.ma_taikhoan = sinhvien.ma_sv
                INNER JOIN nganh on nganh.ma_nganh = sinhvien.ma_nganh
                INNER JOIN khoahoc on khoahoc.ma_khoahoc = sinhvien.ma_khoahoc
                INNER JOIN chitietnhom on chitietnhom.ma_sv = sinhvien.ma_sv
                WHERE ma_nhom = ? AND hoatdong = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $g_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $listUser = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $user = array();
            $user['id'] = $row['ma_taikhoan'];
            $user['name'] = $row['hoten'];
            $user['active'] = $row['hoatdong'];
            $user['role'] = $row['loaitaikhoan'];
            $user['birthday'] = $row['ngaysinh'];
            $user['avatar'] = $row['anh'];
            $user['email'] = $row['email'];
            $user['phone'] = $row['sdt'];
            $user['address'] = $row['diachi'];  
            $user['majors'] = ['majors_id'=>$row['ma_nganh'],
                                'majors_name'=>$row['tennganh']];

            $user['kh'] = ['kh_id'=>$row['ma_khoahoc'],
                            'kh_name'=>$row['tenkhoahoc']]; 
            array_push($listUser, $user);                
        }

        $stmt->close();
        return $listUser;
    }
    function addMember($g_id, $sv_id){
        $stmt = null;
        $sql = "INSERT INTO chitietnhom(ma_nhom, ma_sv)
                VALUES (?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $g_id, $sv_id);
        $rs = true;
        if(!$stmt->execute()){ 
            $rs = false;
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function removeMember($g_id, $sv_id){
        $stmt = null;
        $sql = "DELETE FROM chitietnhom
                WHERE ma_nhom = ? AND ma_sv = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $g_id, $sv_id);
        $rs = true;
        if(!$stmt->execute()){ 
            $rs = false;
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }
}
