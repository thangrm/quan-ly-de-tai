<?php
class categoryModel extends DB
{
    function getListCategory(){ 
        $sql = "SELECT * FROM theloai";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $listCategory = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $category = array();
            // get infor category
            $category['category_id'] = $row['ma_theloai'];
            $category['name'] = $row['tentheloai'];
            array_push($listCategory, $category);
        }
        
        $stmt->close();
        $this->conn->close();
        return $listCategory;
    }

    function add($name){
        $stmt = null;

        // insert theloai table
        $sql = "INSERT INTO theloai(tentheloai) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $name);
        $rs = true;
        if(!$stmt->execute()){ 
            $rs = false;
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function update($cat_id, $name){
        $rs = ['update'=>false,
               'message' => '',
               'cod' => 400];

        // update theloai table
        $sql = "UPDATE theloai 
                SET tentheloai= ? 
                WHERE ma_theloai = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $name, $cat_id);
        if($stmt->execute()){ 
            $rs = ['update'=>true,
                   'message' => '',
                   'cod' => 200];
        }
       
        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function remove($cat_id){
        $rs = ['delete'=>false,
               'message' => '',
               'cod' => 400];
        $sql = "DELETE FROM theloai WHERE ma_theloai = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $cat_id);
        if($stmt->execute()){
            $rs = ['delete'=>true,
                   'message' => '',
                   'cod' => 200];
        }else{
            if(strpos($stmt->error,'a foreign key') !== false){
                $rs['message'] = 'Mã thể loại này đang thuộc các đề tài. Không thể xóa';
            }
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }
}
