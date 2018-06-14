<?php
session_start();
class Addevent extends Controller{
    public function index()
    {
        $this->view("add-event");
    }
    public function add(){
        require_once ('../app/models/Database.php');
        if(isset($_POST['submit'])){
        $us=$_SESSION['username'];
        $conn=Database::getConection();
        $sql=$conn->prepare("select id from users  where username='$us'");
        $sql->execute();
        $result=$sql->get_result();
        $sql->close();
        $userid = mysqli_fetch_assoc($result);
        $userid = $userid["id"];
        $plc = $_POST['loc_plecare'];
        $dest = $_POST['loc_destinatie'];
        $adu = $_POST['nr_adulti'];
        $cop = $_POST['nr_copii'];
        $mot = $_POST['motiv'];
        $dat = $_POST['data_eveniment'];
        $des = $_POST['descriere'];
        $lat_plecare = $_POST['lat_plec'];
        $lng_plecare = $_POST['lng_plec'];
        $lat_destinatie = $_POST['lat_dest'];
        $lng_destinatie = $_POST['lng_dest'];

        $datapostare = date("m/d/Y h:i:s a", time());
        if(empty($userid)||empty($plc)||empty($dest)||empty($adu)||empty($cop)||empty($mot)||empty($dat)||empty($des)){
            header("Location: add-event");
            $_SESSION['error']="Completeaza toate campurile!";
            exit();
        }

        $sql="insert into migration (user_id, loc_plecare,loc_destinatie, nr_adulti, nr_copii, motiv, dataplecare, descriere, data_postare, lat_plecare, lng_plecare, lat_destinatie, lng_destinatie)
              values('$userid', '$plc','$dest', '$adu', '$cop', '$mot', '$dat', '$des','$$datapostare', '$lat_plecare', '$lng_plecare', '$lat_destinatie', '$lng_destinatie')";
        mysqli_query($conn, $sql);
        $conn->close();
        header("Location: main");

        if(isset($_POST['share'])){
            require_once ('../app/models/twitter-app.php');
            $t=new twitter();
            $t->posteaza($us."a raportat un eveniment migratoriu din ".$plc." spre ".$dest." a ".$adu."de adulti si ".$cop." de copii.");
        }

    }
    }
}