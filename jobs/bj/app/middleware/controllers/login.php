<?php
    /**
     *
     */
    class LoginController extends Controller
    {

        function __construct(){
            $this->model = new ModelController();
            $this->view = new View();
        }

        public function index(){
            $this->view->render('login.php');
        }
    }

?>
