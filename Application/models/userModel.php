<?php
class userModel extends DB
{
    function getUserByID($id){
        $char = substr($id,0,2);
        $sql = "SELECT * FROM taikhoan WHERE ma_taikhoan = ? AND hoatdong = 1";
        if($char == 'SV'){
            $sql = "SELECT taikhoan.*, sinhvien.*, tennganh, tenkhoahoc FROM sinhvien 
                    INNER JOIN taikhoan on taikhoan.ma_taikhoan = sinhvien.ma_sv
                    INNER JOIN nganh on nganh.ma_nganh = sinhvien.ma_nganh
                    INNER JOIN khoahoc on khoahoc.ma_khoahoc = sinhvien.ma_khoahoc
                    WHERE ma_taikhoan = ? AND hoatdong = 1";
        }else if($char == 'GV'){
            $sql = "SELECT * FROM taikhoan 
                    INNER JOIN giaovien on taikhoan.ma_taikhoan = giaovien.ma_gv
                    WHERE ma_taikhoan = ? AND hoatdong = 1";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $user['id'] = $row['ma_taikhoan'];
            $user['name'] = $row['hoten'];
            $user['active'] = $row['hoatdong'];
            $user['role'] = $row['loaitaikhoan'];
            $user['birthday'] = $row['ngaysinh'];
            $user['avatar'] = $row['anh'];
            $user['email'] = $row['email'];
            $user['phone'] = $row['sdt'];
            $user['address'] = $row['diachi'];  
            if($char == 'SV'){
                $user['majors'] = ['majors_id'=>$row['ma_nganh'],
                                   'majors_name'=>$row['tennganh']];

                $user['kh'] = ['kh_id'=>$row['ma_khoahoc'],
                               'kh_name'=>$row['tenkhoahoc']];                 
            }else if($char == 'GV'){
                $user['ns'] = $row['gioihansinhvien'];
            }
        }

        $stmt->close();
        return $user;
    }

    function getListUsers($name, $role, $page, $limit){ 
        $name = "%$name%";
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM taikhoan WHERE hoten like ? AND loaitaikhoan = ? AND hoatdong = 1 LIMIT ?, ?";
        if($role == 3){
            $sql = "SELECT taikhoan.*, sinhvien.*, tennganh, tenkhoahoc FROM sinhvien 
                    INNER JOIN taikhoan on taikhoan.ma_taikhoan = sinhvien.ma_sv
                    INNER JOIN nganh on nganh.ma_nganh = sinhvien.ma_nganh
                    INNER JOIN khoahoc on khoahoc.ma_khoahoc = sinhvien.ma_khoahoc
                    WHERE hoten like ? AND loaitaikhoan = ? AND hoatdong = 1 LIMIT ?, ?";
        }else if($role == 2){
            $sql = "SELECT * FROM taikhoan 
                    INNER JOIN giaovien on taikhoan.ma_taikhoan = giaovien.ma_gv
                    WHERE hoten like ? AND loaitaikhoan = ? AND hoatdong = 1 LIMIT ?, ?";
        }


        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('siii', $name, $role, $offset, $limit);

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
            if($role == 3){
                $user['majors'] = ['majors_id'=>$row['ma_nganh'],
                                   'majors_name'=>$row['tennganh']];

                $user['kh'] = ['kh_id'=>$row['ma_khoahoc'],
                               'kh_name'=>$row['tenkhoahoc']];                 
            }else if($role == 2){
                $user['ns'] = $row['gioihansinhvien'];
            }
            array_push($listUser,$user);
        }
        
        $stmt->close();
        $this->conn->close();
        return $listUser;
    }

    function add($role, $name, $birthday, $email, $phone, $address, $majors, $kh, $ns){

        // generate PASS
        $code = rand(100,999);
        $pass = password_hash($code,PASSWORD_DEFAULT);
        $stmt = null;
        $id = "";
        $rs = ['register'=>false,
               'id' => null,
               'pass' => null,
               'cod' => 400];

        // generate ID
        if($role == 3){
            $sql = "SELECT COUNT(*) as n FROM sinhvien
                    WHERE ma_khoahoc = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $kh);
            $stmt->execute();
            $row = mysqli_fetch_assoc($stmt->get_result());
            $num = $row['n'];
            $id = "SV".date("Y").sprintf("%01d", $kh).sprintf("%05d", $num);

        }else if($role == 2){
            $sql = "SELECT COUNT(*) as n FROM giaovien";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = mysqli_fetch_assoc($stmt->get_result());
            $num = $row['n'];
            $id = "GV".date("Y").sprintf("%06d", $num);
        }else{
            return $rs;
        }

        // insert taikhoan table
        $sql = "INSERT INTO `taikhoan`
               (`ma_taikhoan`, `matkhau`, `loaitaikhoan`, `hoten`, `hoatdong`,
                `ngaysinh`, `anh`, `email`, `sdt`, `diachi`) 
                VALUES (?, ?, ?, ?, 1, ?, NULL, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssss', $id,$pass,$role,$name,$birthday,$email,$phone,$address);
        if(!$stmt->execute()){ 
            return $rs;
        }

        // insert into role table
        if($role == 3){
            $sql = "INSERT INTO `sinhvien` (`ma_sv`, `ma_nganh`, `ma_khoahoc`) 
            VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sss',$id, $majors, $kh);

        }else if($role == 2){
            $sql = "INSERT INTO `giaovien` (`ma_gv`, `gioihansinhvien`)
                    VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $id, $ns);
        }

        if($stmt->execute()){
            $rs = ['register'=>true,
                   'id' => $id,
                   'pass' => $code,
                   'cod' => 200];
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function update($id, $pass, $name, $birthday, $avatar, $email, $phone, $address, $majors, $kh, $ns){
        $rs = ['update'=>false,
               'message'=>'',
               'cod' => 400];
        $char = substr($id,0,2);
        $user = $this->getUserByID($id);
        if($user == null){
            $rs['message'] = 'Mã người dùng không tồn tại';
            return $rs;
        }
        
        $stmt = null;
        // check data
        if($name == null)
            $name = $user['name'];

        if($birthday == null)
            $name = $user['birthday'];

        if($avatar == null)
            $name = $user['avatar'];

        if($email == null)
            $name = $user['email'];

        if($phone == null)
            $name = $user['phone'];

        if($address == null)
            $name = $user['address'];


         // update sinhvien or giaovien table
         if($char == 'SV'){
            if($majors == null)
                $majors = $user['majors']['majors_id'];

            if($kh == null)
                $kh = $user['kh']['kh_id'];

            $sql = "UPDATE `sinhvien` 
                    SET `ma_nganh`= ?,
                        `ma_khoahoc`= ?
                        WHERE ma_sv = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sss', $majors, $kh, $id);

        }else if($char == 'GV'){
            if($ns == null)
                $ns = $user['ns']['gioihansinhvien'];

            $sql = "UPDATE `giaovien` 
                    SET `gioihansinhvien`= ? 
                    WHERE ma_gv = ?";
                
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ss', $ns, $id);
        }
        if(!$stmt->execute()){ 
            return $rs;
        }

        // update taikhoan table
        $sql = "UPDATE `taikhoan` 
                SET `matkhau`= ?,
                    `hoten`= ?,
                    `ngaysinh`= ?,
                    `anh`= ?,
                    `email`= ?,
                    `sdt`= ?,
                    `diachi`= ?
                WHERE ma_taikhoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssss', $pass, $name, $birthday, $avatar, $email, $phone, $address, $id);
        if($stmt->execute()){ 
            $rs = ['update'=>true,
                   'message'=>'',
                   'cod' => 200];
        }
       
        
        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function remove($id){
        $rs = ['delete'=>false,
               'message' => 'Bad Request',
               'cod' => 400];
        $sql = "UPDATE `taikhoan` SET `hoatdong`= 0 WHERE ma_taikhoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        if($stmt->execute()){
            if($stmt->affected_rows < 1){
                $rs = ['delete'=>false,
                       'message' => 'Mã người dùng không tồn tại',
                       'cod' => 200];
            }else{
                $rs = ['delete'=>true,
                       'message' => '',
                       'cod' => 200];
            }
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }
}
