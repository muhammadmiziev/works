<?php

    class AdminPanelController extends Controller{

        function __construct() {
            if(!CheckUser::isAccess()) die('permission denied');
            $this->model = new AdminPanelModel();
            $this->view = new View();
        }

        function index(){
            $data = $this->model->getNoAccepted();
            $this->view->render('admin/adminpanel.php', true, $data);
        }

    }

?>
