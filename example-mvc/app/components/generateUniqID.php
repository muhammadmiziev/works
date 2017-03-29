<?php

    class UniqID {

        public static function generate($min=100, $max=9999999){
            // здесь нужно использовать гораздо дольше математики
            return rand($min, $max);

        }

    }

?>
