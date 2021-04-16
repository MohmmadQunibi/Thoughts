<?php
    class Users  extends Controller{
        public function __construct() {

            $this->userModel = $this->model("User");

        }

        public function index() {
            if(isLoggedin()) {
               redirect("posts"); 
            } else {
                redirect("users/login");
            }
        }

        public function register() {
            //Check from posts
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Process form
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                //Init Data
                $data = [
                    "name" => trim($_POST["name"]),
                    "email" => trim($_POST["email"]),
                    "password" => trim($_POST["password"]),
                    "confirm_password" => trim($_POST["confirm_password"]),
                    "name_error" => "",
                    "email_error" => "",
                    "password_error" => "",
                    "confirm_password_error" => "",
                ];

                //Validate email
                if(empty($data["email"])) {
                    $data["email_error"] = "please enter email";
                } else {
                    //check if email exists
                    if($this->userModel->findUserByEmail($data["email"])) {
                        $data["email_error"] = "Email already taken";
                    }
                }

                //validate name
                if(empty($data["name"])) {
                    $data["name_error"] = "please enter name";
                }

                //Validate password
                if(empty($data["password"])) {
                    $data["password_error"] = "please enter password";
                } else if(strlen($data["password"]) < 6) {
                    $data["password_error"] = "password must be bigger than 6";
                }

                //validate confirm password
                if(empty($data["confirm_password"])) {
                    $data["confirm_password_error"] = "please enter the password again";
                } else if($data["password"] != $data["confirm_password"]) {
                    $data["confirm_password_error"] = "passwords don't match";
                }

                //Make sure errors are empty
                if(empty($data["email_error"]) && empty($data["name_error"]) && empty($data["password_error"]) && empty($data["confirm_password_error"])) {
                    //Hash password
                    $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

                    //Register user
                    if($this->userModel->register($data)) {
                        flash("register_success", "You are registered and can log in");
                        redirect("users/login");
                    } else {
                        die("something went wrong");
                    }
                } else {
                    //Load view with errors
                    $this->view("users/register", $data);
                }
            } else {
                //Init Data
                $data =[
                    "name" => "",
                    "email" => "",
                    "password" => "",
                    "confirm_password" => "",
                    "name_error" => "",
                    "email_error" => "",
                    "password_error" => "",
                    "confirm_password_error" => "",
                ];

                //Load the view
                $this->view("users/register", $data);
            }
        }

        public function login() {
            //Check from posts
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Process form

                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init data
                $data =[
                    "email" => trim($_POST["email"]),
                    "password" => trim($_POST["password"]),
                    "email_error" => "",
                    "password_error" => "",
                ];
                
                //Validate email
                if(empty($data["email"])) {
                    $data["email_error"] = "please enter email";
                }

                //validate password
                if(empty($data["password"])) {
                    $data["password_error"] = "please enter password";
                }

                //Check for user/email
                if($this->userModel->findUserByEmail($data["email"])) {
                    //User Found
                } else {
                    $data["email_error"] = "No user Found";
                }

                //Make sure errors are empty
                if(empty($data["email_error"]) && empty($data["password_error"])) {
                    //Validated
                    //Check and set logged in user
                    $loggedInUser = $this->userModel->login($data["email"], $data["password"]);
                    if($loggedInUser) {
                        //Create Session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data["password_error"] = "password incorrect";
                        $this->view("users/login", $data);
                    }
                } else {
                    //Load view with errors
                    $this->view("users/login", $data);
                }
            } else {
                //Init Data
                $data =[
                    "email" => "",
                    "password" => "",
                    "email_error" => "",
                    "password_error" => "",
                ];

                //Load the view
                $this->view("users/login", $data);
            }
        }

        public function createUserSession($user) {
            $_SESSION["user_id"] = $user->id;
            $_SESSION["user_email"] = $user->email;
            $_SESSION["user_name"] = $user->name;
            redirect("posts/index");
        }

        public function logout() {
            unset($_SESSION["user_id"]);
            unset($_SESSION["user_email"]);
            unset($_SESSION["user_password"]);
            session_destroy();
            redirect("users/login");
        }
    }
?>