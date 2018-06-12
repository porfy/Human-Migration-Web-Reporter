<?php
session_start();
class Addevent extends Controller{
    public function index()
    {
        $this->view("add-event");
    }
    public function add(){



    if(isset($_POST['submit'])){
        $us=$_SESSION['username'];
        $conn=Database::getConection();
        $sql="select id from users  where username='$us'";
        $result=mysqli_query($conn,$sql);
        $userid = mysqli_fetch_assoc($result);
        $userid = $userid["id"];
        $plc = $_POST['loc_plecare'];
        $dest = $_POST['loc_destinatie'];
        $adu = $_POST['nr_adulti'];
        $cop = $_POST['nr_copii'];
        $mot = $_POST['motiv'];
        $dat = $_POST['data_eveniment'];
        $des = $_POST['descriere'];
        $datapostare = date("m/d/Y h:i:s a", time());

        $sql="insert into migration (user_id, loc_plecare,loc_destinatie, nr_adulti, nr_copii, motiv, dataplecare, descriere, data_postare)
              values('$userid', '$plc','$dest', '$adu', '$cop', '$mot', '$dat', '$des','$$datapostare')";
        mysqli_query($conn, $sql);
        $conn->close();
        header("Location: main");

        twitter::posteaza();
    }
    }
}