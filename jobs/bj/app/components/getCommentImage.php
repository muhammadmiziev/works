<?php

    class GetComIMG {

        public static function get($rid){
            $path = CONFIG['imageSettings']['pathStorage'].$rid.'.jpg';

            if(file_exists(ROOT.$path)) return $path;

            return 0;

        }

    }

?>
