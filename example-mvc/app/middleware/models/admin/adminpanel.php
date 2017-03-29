<?php

    class AdminPanelModel extends Model{

        function __construct() {}

        public static function getNoAccepted(){
            $data = array();
            $link = DB::Connect();
            $q = DB::Query($link, 'SELECT * FROM reviews WHERE access = 0');
            while ($row = $q->fetch_assoc()) {
                $data[] = $row;
            }
            DB::Disconnect($link);
            return $data;
        }

    }

?>
