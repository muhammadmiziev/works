<?php
    /**
     * MySQL. Escaping string
     */
    class Escape {

        public static function str($link, $str) {
            return mysqli_real_escape_string($link, $str);
        }

        

    }

?>
