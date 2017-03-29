<?php
    /**
     *
     */
    class AdminAjaxController extends Controller{

        function __construct() {
            if(!CheckUser::isAccess()) die();
            $this->model = new AdminAjaxModel();
        }

        function index(){
            if($_SERVER['REQUEST_METHOD'] == 'POST' && CheckUser::isAccess()) {
                $data = file_get_contents('php://input');
                if($data) $data = json_decode($data, true);
                else die();

                switch ($data['cmd']) {
                    case 'update':
                        $result = $this->model->update($data);
                        print_r($result);
                        break;

                    case 'acceptReview':
                        $result = $this->model->acceptReview($data);
                        print_r($result);
                        break;

                    default:
                        print_r('nothing...');
                        break;
                }
            }
        }

    }

?>
