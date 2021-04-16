<?php
    class Pages extends Controller{
        public function __construct() {
        }

        public function index() {
            if(isLoggedin()) {
                redirect("posts");
            }

            $data = [
                "title" => "Thoughts",
                "description" => "simple social network built on the mohmmadmvc PHP framwork"
            ];
            $this->view("pages/index", $data);
        }

        public function about() {
            $data = [
                "title" => "about us",
                "description" => "app to share posts with other users"
            ];
            $this->view("pages/about", $data);
        }
    }
?>