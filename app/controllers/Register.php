<?php
session_start();
class Register extends Controller{
    public function index(){
        $this->view("register");
    }

    public function signup(){
        if(isset($_POST['submit'])){
            require_once ('../app/models/Database.php');
            $conn=Database::getConection();
            $first=mysqli_real_escape_string($conn ,$_POST['first']);
            $last=mysqli_real_escape_string($conn ,$_POST['last']);
            $country=mysqli_real_escape_string($conn ,$_POST['country']);
            $username=mysqli_real_escape_string($conn ,$_POST['username']);
            $email=mysqli_real_escape_string($conn ,$_POST['email']);
            $pwd=mysqli_real_escape_string($conn ,$_POST['pwd']);
            //error handlers
            //Check for empty fields
            if(empty($first)||empty($last) || empty($country) || empty($username) || empty($email)|| empty($pwd)){
                header("Location: register?signup=empty");
                $_SESSION['error']="Completeaza toate campurile!";
                exit();
            }
            else{
                // Check if imput characters are valid
                if(!preg_match("/^[a-zA-Z]*$/",$first)|| !preg_match("/^[a-zA-Z]*$/",$last)|| !preg_match("/^[a-zA-Z]*$/",$country)){
                    header("Location: register");
                    $_SESSION['error']="Imput invalid!";
                    exit();
                }
                else{
                    //Check if email is valid
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        header("Location: register?signup=email");
                        exit();
                    }
                    else{
                        $sql =$conn->prepare( "select * from users where username='$username'");
                        $sql->execute();
                        $result=$sql->get_result();
                        $sql->close();
                        $resultCheck=mysqli_num_rows($result);
                        if($resultCheck > 0){
                            $_SESSION['error']="Alege alt username!";
                            header("Location: register");
                            exit();
                        }
                        else{
                            //hashing the password
                            $hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);
                            $sql=$conn->prepare("insert into users (username,password,firstname,lastname,email,country) values('$username','$hashedPwd','$first','$last','$email','$country')");
                            $sql->execute();
                            $result=$sql->get_result();
                            $sql->close();
                            header("Location: main");
                            $conn->close();
                            exit();
                        }
                    }
                }
            }
        }
        else{
            header("Location: register");
            exit();
        }
    }

}