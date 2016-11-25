<?php
    class MainController extends Controller {

        function __construct(){
            $this->view = new View();
        }

        public function index(){
            $this->view->render('index.php', false);
        }

    }

?>
