<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type: application/json; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống đăng ký đề tài tốt nghiệp khoa CNTT</title>
    <link rel="icon" type="image/x-icon" href="public/images/logo.png">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo getPathCSS('reset.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo getPathCSS('main.css'); ?>">
    <?php
        if(!empty($data['css'])){
            foreach ($data['css'] as $key => $value) {
                echo '<link rel="stylesheet" type="text/css" href="'.getPathCSS($value).'">';
            }
        }

        if(!empty($data['js'])){
            foreach ($data['js'] as $key => $value) {
                echo '<script src="'.getPathJS($value).'"></script>';
            }
        }
    ?>
</head>