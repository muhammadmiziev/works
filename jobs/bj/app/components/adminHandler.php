<?php
    /**
     *
     */
    class AdminHandler{

        function __construct() {
            $data = file_get_contents('php://input');
            if($data) $this->update(json_decode($data, true));

        }

        private function update($data){
            if($this->validData($data)) {
                $link = DB::Connect();
                if(!$link) return false;

                DB::Query($link,
                    "UPDATE reviews
                    SET txt = '".mysqli_real_escape_string($link, $data['txt'])."',
                    changed = 1
                    WHERE ID = '".(int)$data['id']."'
                ");
                $link = DB::Disconnect();
                return 1;
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

            // if($flag)
            //     $data['txt'] = ($data['txt']);

            return $flag;
        }
    }

    new AdminHandler();

?>
