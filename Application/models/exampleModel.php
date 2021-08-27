<?php
class exampleModel extends DB
{
    function getExampleByID($id){

        $sql = "SELECT detaimau.*, gv.hoten as tengv, tl.tentheloai as tentheloai
                FROM detaimau 
                INNER JOIN taikhoan as gv on detaimau.ma_gv = gv.ma_taikhoan 
                INNER JOIN theloai as tl on detaimau.ma_theloai = tl.ma_theloai
                WHERE ma_detaimau = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $example = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $example['example_id'] = $row['ma_detaimau'];
            $example['cat'] = ['cat_id'=>$row['ma_theloai'],
                              'name'=>$row['tentheloai']];
            $example['gv'] = ['gv_id'=>$row['ma_gv'],
                             'name'=>$row['tengv']];
            $example['title'] = $row['tendetai'];
            $example['des'] = $row['mota'];
        }

        $stmt->close();
        return $example;
    }

    function getListExample($uid, $titile, $page, $limit){ 
        $titile = "%$titile%";
        $offset = ($page - 1) * $limit;
        $stmt = null;

        if($uid == null){
            $sql = "SELECT detaimau.*, gv.hoten as tengv, tl.tentheloai as tentheloai
                    FROM detaimau 
                    INNER JOIN taikhoan as gv on detaimau.ma_gv = gv.ma_taikhoan 
                    INNER JOIN theloai as tl on detaimau.ma_theloai = tl.ma_theloai
                    WHERE tendetai like ? LIMIT ?, ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sii', $titile, $offset, $limit);
        }else{
            $sql = "SELECT detaimau.*, gv.hoten as tengv, tl.tentheloai as tentheloai
            FROM detaimau 
            INNER JOIN taikhoan as gv on detaimau.ma_gv = gv.ma_taikhoan 
            INNER JOIN theloai as tl on detaimau.ma_theloai = tl.ma_theloai
            WHERE ma_gv = ? and tendetai like ? LIMIT ?, ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssii', $uid, $titile, $offset, $limit);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $listExample = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $example = array();

            $example['example_id'] = $row['ma_detaimau'];
            $example['cat'] = ['cat_id'=>$row['ma_theloai'],
                              'name'=>$row['tentheloai']];
            $example['gv'] = ['gv_id'=>$row['ma_gv'],
                             'name'=>$row['tengv']];
            $example['title'] = $row['tendetai'];
            $example['des'] = $row['mota'];
            array_push($listExample, $example);
        }
        
        $stmt->close();
        $this->conn->close();
        return $listExample;
    }

    function add($cat_id, $gv_id, $title, $des){

        $stmt = null;

        // insert detaimau table
        $sql = "INSERT INTO detaimau (ma_theloai, ma_gv, tendetai, mota) 
        VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $cat_id, $gv_id, $title, $des);
        $rs = true;
        if(!$stmt->execute()){ 
            $rs = false;
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function update($example_id, $cat_id, $title, $des){
        $rs = ['update'=>false,
               'message' => '',
               'cod' => 400];

        // update detaimau table
        $sql = "UPDATE detaimau 
                SET ma_theloai = ?,
                    tendetai = ?,
                    mota = ?
                WHERE ma_detaimau = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('issi', $cat_id, $title, $des, $example_id);
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
        $sql = "DELETE FROM detaimau WHERE ma_detaimau = ?";
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
