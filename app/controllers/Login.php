<?php
session_start();
class Login extends Controller{
    public function index(){
        $this->view("login");
    }
    public function loginf(){
        if(isset($_POST['submit'])){
            include_once 'dbconn.php';
            $username=mysqli_real_escape_string($conn,$_POST['username']);
            $password=mysqli_real_escape_string($conn,$_POST['password']);

            $sql="Select * from users where username='$username'";
            $result=mysqli_query($conn,$sql);
            $resultCheck= mysqli_num_rows($result);
            if($resultCheck < 1){
                $_SESSION['Error']="UsErnamE sau parola grEsita!";
                header("Location: login");
                exit();
            }
            else{
                if($row=mysqli_fetch_assoc($result)){
                    //de-hashing the password
                    $hashedPwdCheck= password_verify($password,$row['password']);
                    if($hashedPwdCheck==false){
                        $_SESSION['Error']="UsErnamE sau parola grEsita!";
                        header("Location: login");
                        exit();
                    }
                    elseif($hashedPwdCheck==true){
                        $_SESSION['username']=$username;
                        $_SESSION['loged_in']='true';
                        header("Location: main");
                        exit();
                    }
                }
            }

        }
        else{
            header("Location: login-error");
            exit();
        }
    }
}