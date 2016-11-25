<?php

    /**
     * Main Viewer !
     */
    class View {

        public function render($view, $template=true, $data=null){
            if(!$template) include('app/middleware/views/'.$view);
            else {
                $template = 'common_tpl.php';
                include('app/middleware/views/'.$template);
            }
        }

    }


?>
