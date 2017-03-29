<?php
    /**
     * Проверка на авторизацию
     */

    class CheckUser{
        public static function isAccess(){
            if(session_status() == PHP_SESSION_NONE) return 0x00;
            else {
                if(self::check()) return 0x01;
                else return 0x00;
            }
        }
        private static function check(){
            $ua = md5($_SERVER['HTTP_USER_AGENT']);
            $ip = md5($_SERVER['REMOTE_ADDR']);

            if(

                isset($_SESSION['AUTH']) && count($_SESSION['AUTH']) > 0 &&
                isset($_SESSION['AUTH']['compare']) && count($_SESSION['AUTH']['compare']) > 0 &&
                ($_SESSION['AUTH']['compare']['ua'] == $ua)

            ) return 1;
            else return 0;
             # не проверяю ip, ибо он может быть динамическим
        }
    }


?>
