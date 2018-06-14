<?php
session_start();
class User extends Controller
{
    public function index()
    {
        $this->view("user");
    }

    public function info()
    {
        require_once ('../app/models/Database.php');
        $conn = Database::getConection();
        $nrPostari = 0;
        $us = $_SESSION['username'];
        $user_id=0;
        $sql=$conn->prepare("select id,firstname,lastname,country,email from users where username='$us'");
        $sql->execute();
        $result=$sql->get_result();
        $sql->close();
        $row=mysqli_fetch_assoc($result);
        $user_id=$row['id'];
        $nume=$row['lastname'];
        $prenume=$row['firstname'];
        $tara=$row['country'];
        $email=$row['email'];
        $sql =$conn->prepare( "select count(*) as num from migration where user_id='$user_id'");
        $sql->execute();
        $result=$sql->get_result();
        $sql->close();
        $row=mysqli_fetch_assoc($result);
        $nrPostari=$row['num'];
        $_SESSION['nr_postari']=$nrPostari;
        $_SESSION['nume']=$nume;
        $_SESSION['prenume']=$prenume;
        $_SESSION['tara']=$tara;
        $_SESSION['email']=$email;
    }
}
