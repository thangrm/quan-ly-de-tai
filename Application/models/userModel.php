<?php
class userModel extends DB
{
    function getUserByID($id)
    { 
        $sql = "SELECT * FROM taikhoan WHERE ma_taikhoan = ? AND hoatdong = 1";
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
        }

        $stmt->close();
        $this->conn->close();
        return $user;
    }

    function getListUsers($name, $role, $page, $limit)
    { 
        $name = "%$name%";
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM taikhoan WHERE hoten like ? AND loaitaikhoan = ? LIMIT ?, ?";
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
               'code' => 400];

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
                   'code' => 200];
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }
}
