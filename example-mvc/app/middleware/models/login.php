<?php
    /**
     * для примера про
     */
    class ModelController extends Model
    {

        function __construct(){
            if(isset($_POST['sub']) && self::dataValid($_POST)) {
                $data = $_POST;
                $chkU = self::checkUser($data);
                if($chkU) {
                    if(self::setCookie($chkU[0]))
                        header('Location: /');
                } else {
                    echo 'no';
                }
            }
        }

        private static function checkUser($data){
            $link = DB::Connect();
            $result = array();

            $q = DB::Query($link, "SELECT uid, name FROM users WHERE
                login = '".mysqli_real_escape_string($link, $data['login'])."'
                AND
                password = '". self::SuperSuperCryp($data['password']) ."'
            ");

            if($q->num_rows <= 0) return 0;

            while ($row = $q->fetch_assoc()) {
                $result[] = $row;
            }
            return $result;
        }

        private static function dataValid($data) {
            # some check
            if(strlen($data['login']) > 3 && strlen($data['login']) > 2)
                return 1;
        }

        private static function setCookie($data){
            // на всякий случай
            // if (session_status() == PHP_SESSION_NONE) {
            //     session_name(CONFIG['sessions']['name']);
            //     session_start();
            //     # or 'return false;'
            // }

            $_SESSION['AUTH'] = array(
                "uid" => $data['uid'],
                "name" => $data['name'],
                "compare" => array( // нужно для дополнительной безопасности
                    "ua" => md5($_SERVER['HTTP_USER_AGENT']),
                    "ip" => md5($_SERVER['REMOTE_ADDR'])
                )
            );
            return 1;
        }

        private static function SuperSuperCryp($target){
            // $salt = CONFIG['authSalt'];
            return md5($target);
        }

    }
?>
