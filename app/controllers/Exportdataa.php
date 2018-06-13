<?php
session_start();
class Pereche{
    public $data;
    public $numar;
}

class Exportdataa extends Controller
{
    public function index()
    {
        $this->view("export-data");
    }
    public function setChart(){
        $conn=Database::getConection();
        $sql="select sum(nr_adulti) as adulti,loc_plecare as plecare from migration group by loc_plecare";
        $result=mysqli_query($conn,$sql);
        $nrTotal=0;
        $p= new Pereche();
        $i=0;
        while ($i<5&&$row=mysqli_fetch_assoc($result)){
            $i=$i+1;
            $p->data=$row['plecare'];
            $p->numar=$row['adulti'];
            $myjson=json_encode($p);
            $_SESSION['date']=$myjson;
        }
        
    }
}

?>