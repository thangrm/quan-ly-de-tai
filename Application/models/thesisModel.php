<?php
class thesisModel extends DB
{
    function getThesisByID($id){

        $sql = "SELECT detai.*, sv.hoten as tensv, gv.hoten as tengv, tl.tentheloai as tentheloai
                FROM detai 
                INNER JOIN taikhoan as sv on detai.ma_sv = sv.ma_taikhoan 
                INNER JOIN taikhoan as gv on detai.ma_gv = gv.ma_taikhoan 
                INNER JOIN theloai as tl on detai.ma_theloai = tl.ma_theloai
                WHERE ma_detai = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $thesis = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $thesis['thesis_id'] = $row['ma_detai'];
            $thesis['cat'] = ['cat_id'=>$row['ma_theloai'],
                              'name'=>$row['tentheloai']];
            $thesis['sv'] = ['sv_id'=>$row['ma_sv'],
                             'name'=>$row['tensv']];
            $thesis['gv'] = ['gv_id'=>$row['ma_gv'],
                             'name'=>$row['tengv']];
            $thesis['title'] = $row['tendetai'];
            $thesis['des'] = $row['mota'];
            $thesis['approve'] = $row['pheduyet'];
            $thesis['complete'] = $row['hoanthanh'];
        }

        $stmt->close();
        return $thesis;
    }

    function getThesisByUser($uid, $cat_id, $titile, $page, $limit){ 
        $titile = "%$titile%";
        $offset = ($page - 1) * $limit;
        $stmt = null;

        if($uid == null){
            $sql = "SELECT detai.*, gv.hoten as tengv, sv.*, nganh.*, khoahoc.*, tl.tentheloai as tentheloai
                    FROM detai 
                    INNER JOIN taikhoan as sv on detai.ma_sv = sv.ma_taikhoan 
                    INNER JOIN taikhoan as gv on detai.ma_gv = gv.ma_taikhoan 
                    INNER JOIN theloai as tl on detai.ma_theloai = tl.ma_theloai
                    INNER JOIN sinhvien on sinhvien.ma_sv = detai.ma_sv
                    INNER JOIN nganh on nganh.ma_nganh = sinhvien.ma_nganh
                    INNER JOIN khoahoc on khoahoc.ma_khoahoc = sinhvien.ma_khoahoc
                    WHERE tendetai like ? AND (tl.ma_theloai =  ? or ? = -1) LIMIT ?, ?";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('siiii', $titile, $cat_id, $cat_id, $offset, $limit);
        }else{
            $char = substr($uid,0,2);
            $column_uid = "";
    
            if($char == 'GV'){
                $column_uid = 'ma_gv';
            }else if($char == 'SV'){
                $column_uid = 'ma_sv';
            }else{
                return 400;
            }

            $sql = "SELECT detai.*, gv.hoten as tengv, sv.*, nganh.*, khoahoc.*, tl.tentheloai as tentheloai
                    FROM detai 
                    INNER JOIN taikhoan as sv on detai.ma_sv = sv.ma_taikhoan 
                    INNER JOIN taikhoan as gv on detai.ma_gv = gv.ma_taikhoan 
                    INNER JOIN theloai as tl on detai.ma_theloai = tl.ma_theloai
                    INNER JOIN sinhvien on sinhvien.ma_sv = detai.ma_sv
                    INNER JOIN nganh on nganh.ma_nganh = sinhvien.ma_nganh
                    INNER JOIN khoahoc on khoahoc.ma_khoahoc = sinhvien.ma_khoahoc
                    WHERE  detai.$column_uid = ? AND tendetai like ? AND (tl.ma_theloai =  ? or ? = -1) LIMIT ?, ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssiiii', $uid, $titile, $cat_id, $cat_id, $offset, $limit);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $listThesis = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $thesis = array();
            $user = array();
            //get infor user
            $user['sv_id'] = $row['ma_taikhoan'];
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


            // get infor thesis
            $thesis['thesis_id'] = $row['ma_detai'];
            $thesis['cat'] = ['cat_id'=>$row['ma_theloai'],
                              'name'=>$row['tentheloai']];
            $thesis['sv'] = $user;
            $thesis['gv'] = ['gv_id'=>$row['ma_gv'],
                             'name'=>$row['tengv']];
            $thesis['title'] = $row['tendetai'];
            $thesis['des'] = $row['mota'];
            $thesis['approve'] = $row['pheduyet'];
            $thesis['complete'] = $row['hoanthanh'];
            array_push($listThesis, $thesis);
        }
        
        $stmt->close();
        return $listThesis;
    }

    function add($cat_id, $sv_id, $gv_id, $title, $des){
        $thesis = $this->getThesisByUser($sv_id, -1, "",1,25);
        if(count($thesis) > 0){
            return false;
        }
        $stmt = null;

        // insert detai table
        $sql = "INSERT INTO detai (ma_theloai, ma_gv, ma_sv, tendetai, mota) 
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $cat_id, $gv_id, $sv_id, $title, $des);
        $rs = true;
        if(!$stmt->execute()){ 
            $rs = false;
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function update($thesis_id, $cat_id, $gv_id, $title, $des, $approve, $complete){
        $rs = ['update'=>false,
               'message' => '',
               'cod' => 400];

        // update detai table
        $sql = "UPDATE detai 
                SET ma_theloai = ?,
                    ma_gv = ?,
                    tendetai = ?,
                    mota = ?,
                    pheduyet = ?,
                    hoanthanh = ?
                WHERE ma_detai = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('issssss', $cat_id, $gv_id, $title, $des, $approve, $complete, $thesis_id);
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
               'cod' => 400];
        $sql = "DELETE FROM detai WHERE ma_detai = ?";
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
}
