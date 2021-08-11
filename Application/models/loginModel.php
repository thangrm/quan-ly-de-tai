<?php
class loginModel extends DB
{
    function check_login($data)
    { 
        $sql = "SELECT * FROM taikhoan WHERE ma_taikhoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $data['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = array();
        while ($row = mysqli_fetch_assoc($result)) {
            if(password_verify($data['password'], $row['matkhau'])){
                $user['username'] = $row['ma_taikhoan'];
                $user['name'] = $row['hoten'];
                $user['role'] = $row['loaitaikhoan'];
            }  
        }

        $stmt->close();
        $this->conn->close();
        return $user;
    }
}
