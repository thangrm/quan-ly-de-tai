<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type: application/json; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhóm 23</title>
    <link rel="stylesheet" type="text/css" href="public/css/reset.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <?php
        if(!empty($data['css'])){
            foreach ($data['css'] as $key => $value) {
                echo '<link rel="stylesheet" type="text/css" href="public/css/'.$value.'.css">';
            }
        }

        if(!empty($data['js'])){
            foreach ($data['js'] as $key => $value) {
                echo '<script src="public/javascript/'.$value.'.js"></script>';
            }
        }
    ?>
</head>