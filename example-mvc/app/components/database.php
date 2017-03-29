<?php
    /**
     * Data Base. MySQL
     */
    class DB {

        private static $credentials;
        private static $link;

        public static function Connect() {
            self::$credentials = CONFIG['database'];

            $connect = new mysqli(
                self::$credentials['host'],
                self::$credentials['user'],
                self::$credentials['password'],
                self::$credentials['database']
            );

            self::$link = $connect;
            return self::$link;
        }

        public static function Query($link, $q) {
            $link->query("set_client='utf8'");
			$link->query("Set character_set_client = utf8");
			$link->query("Set character_set_connection = utf8");
			$link->query("Set character_set_results = utf8");
			$link->query("Set collation_connection = utf8_general_ci");
            
            return $link->query($q);
        }

        public static function Disconnect($link) {
            $link->close();
        }

    }

?>
