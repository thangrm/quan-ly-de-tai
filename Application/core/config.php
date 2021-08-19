<?php
    // Hàm lấy base url bằng PHP
    function getBaseUrl() {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF'];

        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath);

        // output: localhost
        $hostName = $_SERVER['HTTP_HOST'];

        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';

        // return: http://localhost/myproject/
        return ($protocol . '://' . $hostName . $pathInfo['dirname'] . "/");
    }

    //Hàm lấy url 
    function getUrl($controller){
        return getBaseUrl().$controller;
    }

    //Hàm lấy đường dẫn file css
    function getPathCSS($nameFile){
        return getBaseUrl().'public/css/'.$nameFile;
    }

    //Hàm lấy đường dẫn file javascript
    function getPathJS($nameFile){
        return getBaseUrl().'public/javascript/'.$nameFile;
    }

    //Hàm lấy đường dẫn ảnh
    function getPathImg($nameFile){
        return getBaseUrl().'public/images/'.$nameFile;
    }

    //Hàm lấy đường dẫn file
    function getPathStorage($nameFile){
        return getBaseUrl().'storage/'.$nameFile;
    }

    //Hàm lấy đường dẫn tuyết đối thư mục storage trên server
    function getRealPathStorage($nameFile){
        $folder = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']);
        return $folder.'/storage/'.$nameFile;
    }
?>