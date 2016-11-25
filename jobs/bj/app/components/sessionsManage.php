<?php
    class SessionsManage {

        public static function Set(){
            session_name(CONFIG['sessions']['name']);
            session_start();
        }
        public static function Unset(){
            session_destroy();
        }

    }


?>
