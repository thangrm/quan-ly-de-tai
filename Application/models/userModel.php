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
}
