<?php
    class FeedbackController extends Controller {

        function __construct(){
            $this->view = new View();
            $this->model = new FeedbackModel();

            if($_SERVER['REQUEST_METHOD'] == 'POST')
                $this->model->handleFeedback($_POST);
        }

        public function index(){
            $data = $this->model->getData();

            $this->view->render('feedback.php', true, $data);
        }

    }

?>
