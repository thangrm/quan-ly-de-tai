<?php    
    class API extends conectMV
    {
        // Các method của HTTP
        protected $method = '';

        // Quyền hạn của request
        protected $role = null;

        public $ADMIN_ROLE = 1;
        public $GIAOVIEN_ROLE = 2;
        public $SINHVIEN_ROLE = 3;

        public function __construct() {
            header("Access-Control-Allow-Orgin: *");
            header("Access-Control-Allow-Methods: *");
            header("Content-Type: application/json");

            $this->method = $_SERVER['REQUEST_METHOD'];
            if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
                if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                    $this->method = 'DELETE';
                } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                    $this->method = 'PUT';
                } else {
                    throw new Exception("Unexpected Header");
                }
            }

            switch($this->method) {
                case 'DELETE':
                    break;
                case 'POST':
                    $this->args = $_POST;
                    break;
                case 'GET':
                    break;
                case 'PUT':
                    $this->file = file_get_contents("php://input");
                    break;
                default:
                    $this->response('Invalid Method', 405);
                    break;
            }

            $this->role = $this->getRoleUser();
        }

        protected function getRoleUser() {
            if(isset($_SESSION['login']['role'])){
                return $_SESSION['login']['role'];
            }else{
                return null;
            }
        }

        protected function response($data, $status = 200) {
            header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
            return json_encode($data);
        }

        protected function responseStatus($status, $message = null){
            header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
            if($message == null){
                $message = $this->requestStatus($status);
            }
            return json_encode(['cod' => $status, 
                                'message'=> $message]);
        }

        private function requestStatus($code) {
            $status = array(  
                100 => 'Continue',  
                101 => 'Switching Protocols',  
                200 => 'OK',
                201 => 'Created',  
                202 => 'Accepted',  
                203 => 'Non-Authoritative Information',  
                204 => 'No Content',  
                205 => 'Reset Content',  
                206 => 'Partial Content',  
                300 => 'Multiple Choices',  
                301 => 'Moved Permanently',  
                302 => 'Found',  
                303 => 'See Other',  
                304 => 'Not Modified',  
                305 => 'Use Proxy',  
                306 => '(Unused)',  
                307 => 'Temporary Redirect',  
                400 => 'Bad Request',  
                401 => 'Unauthorized',  
                402 => 'Payment Required',  
                403 => 'Forbidden',  
                404 => 'Not Found',  
                405 => 'Method Not Allowed',  
                406 => 'Not Acceptable',  
                407 => 'Proxy Authentication Required',  
                408 => 'Request Timeout',  
                409 => 'Conflict',  
                410 => 'Gone',  
                411 => 'Length Required',  
                412 => 'Precondition Failed',  
                413 => 'Request Entity Too Large',  
                414 => 'Request-URI Too Long',  
                415 => 'Unsupported Media Type',  
                416 => 'Requested Range Not Satisfiable',  
                417 => 'Expectation Failed',
                500 => 'Internal Server Error',  
                501 => 'Not Implemented',  
                502 => 'Bad Gateway',  
                503 => 'Service Unavailable',  
                504 => 'Gateway Timeout',  
                505 => 'HTTP Version Not Supported'
            ); 
            return ($status[$code])?$status[$code]:$status[500]; 
        }

        private function cleanInputs($data) {
            $clean_input = Array();
            if (is_array($data)) {
                foreach ($data as $k => $v) {
                    $clean_input[$k] = $this->cleanInputs($v);
                }
            } else {
                $clean_input = trim(strip_tags($data));
            }
            return $clean_input;
        }
    }
?>