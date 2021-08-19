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

    function getThesisByUser($uid, $titile, $approve, $complete, $page, $limit){ 
        $titile = "%$titile%";
        $offset = ($page - 1) * $limit;
        $stmt = null;

        if($uid == null){
            $sql = "SELECT detai.*, sv.hoten as tensv, gv.hoten as tengv, tl.tentheloai as tentheloai
                    FROM detai 
                    INNER JOIN taikhoan as sv on detai.ma_sv = sv.ma_taikhoan 
                    INNER JOIN taikhoan as gv on detai.ma_gv = gv.ma_taikhoan 
                    INNER JOIN theloai as tl on detai.ma_theloai = tl.ma_theloai
                    WHERE tendetai like ? AND pheduyet = ? AND hoanthanh = ? LIMIT ?, ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('siiii', $titile, $approve, $complete, $offset, $limit);
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

            $sql = "SELECT detai.*, sv.hoten as tensv, gv.hoten as tengv, tl.tentheloai as tentheloai
                    FROM detai 
                    INNER JOIN taikhoan as sv on detai.ma_sv = sv.ma_taikhoan 
                    INNER JOIN taikhoan as gv on detai.ma_gv = gv.ma_taikhoan 
                    INNER JOIN theloai as tl on detai.ma_theloai = tl.ma_theloai
                    WHERE  $column_uid = ? AND tendetai like ? AND pheduyet = ? AND hoanthanh = ? LIMIT ?, ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssiiii', $uid, $titile, $approve, $complete, $offset, $limit);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $listThesis = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $thesis = array();
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
            array_push($listThesis, $thesis);
        }
        
        $stmt->close();
        $this->conn->close();
        return $listThesis;
    }

    function add($cat_id, $sv_id, $gv_id, $title, $des){

        $stmt = null;

        // insert taikhoan table
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

    function update($thesis_id, $cat_id, $title, $des, $approve, $complete){
        $rs = ['update'=>false,
               'message' => '',
               'cod' => 400];

        // update detai table
        $sql = "UPDATE detai 
                SET ma_theloai = ?,
                    tendetai = ?,
                    mota = ?,
                    pheduyet = ?,
                    hoanthanh = ?
                WHERE ma_detai = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isssss', $cat_id, $title, $des, $approve, $complete, $thesis_id);
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
