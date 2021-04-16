<?php
    class Posts extends Controller {

        public function __construct() {
            if(!isLoggedin()) {
                redirect("users/login");
            }

            $this->postModel = $this->model("Post");
            $this->userModel = $this->model("User");
        }

        public function index() {
            //Get posts
            $posts = $this->postModel->getPosts();

            $data = [
                "posts" => $posts,
            ];

            $this->view("posts/index", $data);
        }

        public function add() {
            //Check the request
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "title" => trim($_POST["title"]),
                    "body" => trim($_POST["body"]),
                    "user_id" => $_SESSION["user_id"],
                    "title_error" => "",
                    "body_error" => ""
                ];

                //Validate the title
                if(empty($data["title"])) {
                    $data["title_error"] = "Please enter a title";
                }

                //Validate the data
                if(empty($data["body"])) {
                    $data["body_error"] = "Please enter a body";
                }

                //Make sure there is no errors
                if(empty($data["title_error"]) && empty($data["body_error"])) {
                    //Validated
                    if($this->postModel->addPost($data)) {
                        flash("post_message", "Post added");
                        redirect("posts");
                    } else {
                        die("Something went wrong");
                    }
                } else {
                    //Load view with errors
                    $this->view("posts/add", $data);
                }

            } else {
                $data = [
                    "title" => "",
                    "body" => "",
                ];

                $this->view("posts/add", $data);
            }
        }

        public function show($id) {
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);

            $data = [
                "post" => $post,
                "user" => $user
            ];

            $this->view("posts/show", $data);
        }

        public function edit($id) {
            //Check the request
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "id" => $id,
                    "title" => trim($_POST["title"]),
                    "body" => trim($_POST["body"]),
                    "user_id" => $_SESSION["user_id"],
                    "title_error" => "",
                    "body_error" => ""
                ];

                //Validate the title
                if(empty($data["title"])) {
                    $data["title_error"] = "Please enter a title";
                }

                //Validate the data
                if(empty($data["body"])) {
                    $data["body_error"] = "Please enter a body";
                }

                //Make sure there is no errors
                if(empty($data["title_error"]) && empty($data["body_error"])) {
                    //Validated
                    if($this->postModel->updatePost($data)) {
                        flash("post_message", "Post updated");
                        redirect("posts");
                    } else {
                        die("Something went wrong");
                    }
                } else {
                    //Load view with errors
                    $this->view("posts/edit", $data);
                }

            } else {
                //Get exciting post from model
                $post = $this->postModel->getPostById($id);

                //Check for owner
                if($post->user_id != $_SESSION["user_id"]) {
                    redirect("posts");
                }
                $data = [
                    "id" => $id,
                    "title" => $post->title,
                    "body" => $post->body
                ];

                $this->view("posts/edit", $data);
            }
        }

        public function delete($id) {
            if($_SERVER["REQUEST_METHOD"] == "POST") {

                //Check for owner
                if($post->user_id != $_SESSION["user_id"]) {
                    redirect("posts");
                }

                if($this->postModel->deletePost($id)) {
                    flash("post_message", "Post removed");
                    redirect("posts");
                } else {
                    die("Something went wrong");
                }
            } else {
                redirect("posts");
            }
        }
    }
?>