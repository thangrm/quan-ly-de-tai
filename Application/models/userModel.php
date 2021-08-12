<?php
class userModel extends DB
{
    function getUserByID($id)
    { 
        $sql = "SELECT * FROM taikhoan WHERE ma_taikhoan = ?";
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
}
