<?php
class assignmentModel extends DB
{
    function getAssignmentByID($id, $sv_id = null){
        //get assignment infor
        $sql = "SELECT * FROM baitap WHERE ma_baitap = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $assignment = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $assignment['id'] = $row['ma_baitap'];
            $assignment['gid'] = $row['ma_nhom'];
            $assignment['title'] = $row['tieude'];
            $assignment['content'] = $row['noidung'];
            $assignment['postDate'] = $row['ngaydang'];
            $assignment['deadline'] = $row['hannop'];
        }
        if($assignment != null){
            // get assignment detail
            if($sv_id == null){
                $sql = "SELECT chitietbaitap.*, hoten FROM chitietbaitap 
                INNER JOIN taikhoan on chitietbaitap.ma_sv = taikhoan.ma_taikhoan
                WHERE ma_baitap = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('i', $id);
            }else{
                $sql = "SELECT chitietbaitap.*, hoten FROM chitietbaitap 
                INNER JOIN taikhoan on chitietbaitap.ma_sv = taikhoan.ma_taikhoan
                WHERE ma_baitap = ? and ma_sv = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('is', $id, $sv_id);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $listDetail = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $detail = array();
                $detail['sv_id'] = $row['ma_sv'];
                $detail['name'] = $row['hoten'];
                $detail['file'] = $row['file'];
                $detail['score'] = $row['diem'];
                $detail['dateSubmit'] = $row['thoigiannop'];
                array_push($listDetail, $detail);
            }
            $assignment['detail'] = $listDetail;
        }
        
        $stmt->close();
        return $assignment;
    }

    function getAssignmentByGroup($gid, $page, $limit){
        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM `baitap` WHERE ma_nhom = ? LIMIT ?, ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iii', $gid, $offset, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $listAssignment = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $assignment = array();
            $assignment['id'] = $row['ma_baitap'];
            $assignment['gid'] = $row['ma_nhom'];
            $assignment['title'] = $row['tieude'];
            $assignment['content'] = $row['noidung'];
            $assignment['postDate'] = $row['ngaydang'];
            $assignment['deadline'] = $row['hannop'];
            array_push($listAssignment, $assignment);
        }

        $stmt->close();
        return $listAssignment;
    }

    function getAssignmentByDetailID($id){
        $sql = "SELECT baitap.*
                FROM chitietbaitap 
                INNER JOIN baitap ON chitietbaitap.ma_baitap = baitap.ma_baitap 
                WHERE ma_chitietbaitap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $assignment = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $assignment['id'] = $row['ma_baitap'];
            $assignment['gid'] = $row['ma_nhom'];
            $assignment['title'] = $row['tieude'];
            $assignment['content'] = $row['noidung'];
            $assignment['postDate'] = $row['ngaydang'];
            $assignment['deadline'] = $row['hannop'];
        }

        $stmt->close();
        return $assignment;
    }

    function add($gid, $title, $content, $deadline){
        $stmt = null;

        // insert detai table
        $sql = "INSERT INTO baitap (ma_nhom, tieude, noidung, hannop) 
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isss', $gid, $title, $content, $deadline);
        $rs = true;
        if(!$stmt->execute()){ 
            $rs = false;
        }

        $stmt->close();
        $this->conn->close();
        return $rs;  
    }

    function update($id, $title, $content, $hannop){
        $rs = ['update'=>false,
               'message' => '',
               'cod' => 400];

        // update baitap table
        $sql = "UPDATE baitap 
                SET tieude = ?,
                    noidung = ?,
                    hannop = ?
                WHERE ma_baitap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssi', $title, $content, $hannop, $id);
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
        $sql = "DELETE FROM baitap WHERE ma_baitap = ?";
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

    /* chitietbaitap table */

    function submit($id, $file){
        $rs = ['submit'=>false,
               'message' => '',
               'cod' => 400];

        $sql = "UPDATE chitietbaitap
                SET file = ?,
                    thoigiannop = CURRENT_TIMESTAMP
                WHERE ma_chitietbaitap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si',$file, $id);
        if($stmt->execute()){
            $rs = ['submit'=>true,
                   'message' => '',
                   'cod' => 200];
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    function assess($id, $score){
        $rs = ['assess'=>false,
               'message' => '',
               'cod' => 400];

        $sql = "UPDATE chitietbaitap
                SET diem = ?
                WHERE ma_chitietbaitap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii',$score, $id);
        if($stmt->execute()){
            $rs = ['assess'=>true,
                   'message' => '',
                   'cod' => 200];
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }

    /* ykien table */
    function getOpinion($id){
        $sql = "SELECT ykien.*, hoten
                FROM ykien 
                INNER JOIN taikhoan on taikhoan.ma_taikhoan = ykien.ma_taikhoan
                WHERE ma_chitietbaitap = ?
                ORDER BY thoigian_ykien ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $listOpinion = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $opinion = array();
            $opinion['opinion_id'] = $row['ma_ykien'];
            $opinion['detail_id'] = $row['ma_chitietbaitap'];
            $opinion['user_id'] = $row['ma_taikhoan'];
            $opinion['name'] = $row['hoten'];
            $opinion['content'] = $row['noidung_ykien'];
            $opinion['time'] = $row['thoigian_ykien'];
            array_push($listOpinion, $opinion);
        }

        $stmt->close();
        return $listOpinion;
    }

    function addOpinion($id, $uid, $content){
        $rs = ['opinion'=>false,
               'message' => '',
               'cod' => 400];

        $sql = "INSERT INTO ykien(ma_chitietbaitap, ma_taikhoan, noidung_ykien)
                VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iss',$id, $uid, $content);
        if($stmt->execute()){
            $rs = ['opinion'=>true,
                   'message' => '',
                   'cod' => 200];
        }

        $stmt->close();
        $this->conn->close();
        return $rs;
    }
}
