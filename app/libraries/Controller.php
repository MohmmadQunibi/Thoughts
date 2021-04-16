<?php
    //this is the controller
    //it loads the models and views
    class Controller {
        //load the model
        public function model($model) {
            //require model file
            require_once "../app/models/" . $model . ".php";

            //inisiate model
            return new $model();
        }

        //load the view
        public function view($view, $data = []) {
            //check for view file
            if(file_exists("../app/views/" . $view . ".php")) {
                require_once "../app/views/" . $view . ".php";
            } else {
                //view doesnot exists
                die("view does not exist");
            }
        }
    }
?>