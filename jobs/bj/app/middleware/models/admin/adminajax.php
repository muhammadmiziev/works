<?php
    /**
     *
     */
    class AdminAjaxModel extends Model{

        function __construct() {}
        function index(){}

        public function update($data){
            if($this->validData($data)) {
                $link = DB::Connect();
                if(!$link) return false;
                DB::Query($link,
                    "UPDATE reviews
                    SET txt = '".mysqli_real_escape_string($link, $data['txt'])."',
                    changed = 1
                    WHERE rid = '".(int)$data['id']."'
                ");
                DB::Disconnect($link);
                return json_encode(array(
                    'status' => 1,
                    'info' => 'ok'
                ));
            } else {
                return json_encode(array(
                    'status' => 0,
                    'info' => 'data no valid'
                ));
            }
        }
        private function validData($data){
            $flag = 1;

            $patterns = array(
                'txt'   => '/.*/'
            );

            foreach ($patterns as $key => $value) {
                if(!preg_match($patterns[$key], $data[$key])) $flag = 0;
            }

            return $flag;
        }

        public function acceptReview($data){
            $link = DB::Connect();
            if(!$link) return false;
            $q = DB::Query($link,
                "UPDATE reviews
                SET access = 1
                WHERE rid = '".(int)$data['rid']."'
            ");
            DB::Disconnect($link);
            if($q) return json_encode(array(
                'status' => 1,
                'info' => 'ok'
            ));
        }
    }


?>
