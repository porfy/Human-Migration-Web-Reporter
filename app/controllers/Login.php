<?php
session_start();
class Login extends Controller{
    public function index(){
        $this->view("login");
    }
    public function loginf(){
        if(isset($_POST['submit'])){
            require_once ('../app/models/Database.php');
            $conn=Database::getConection();
            $username=mysqli_real_escape_string($conn,$_POST['username']);
            $password=mysqli_real_escape_string($conn,$_POST['password']);
            $sql=$conn->prepare("Select * from users where username=(?)");
            $sql->bind_param('s',$username);
            $sql->execute();
            $result=$sql->get_result();
            $sql->close();
            $resultCheck= mysqli_num_rows($result);
            if($resultCheck < 1){

                $_SESSION['Error']="Username sau parola gresita!";
                $_SESSION['Time']=date("m/d/Y h:i:s a", time());
                header("Location: login");
                exit();
            }
            else{
                if($row=mysqli_fetch_assoc($result)){
                    //de-hashing the password
                    $hashedPwdCheck= password_verify($password,$row['password']);
                    if($hashedPwdCheck==false){
                        $_SESSION['Error']="Username sau parola gresita!";
                        header("Location: login");
                        exit();
                    }
                    elseif($hashedPwdCheck==true){
                        $_SESSION['username']=$username;
                        $_SESSION['loged_in']='true';
                        $conn->close();
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