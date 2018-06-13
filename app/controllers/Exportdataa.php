<?php
session_start();

class Exportdataa extends Controller
{
    public function index()
    {
        $this->view("export-data");
    }
    public function setChart(){
        require_once ('../app/models/Database.php');
        $conn=Database::getConection();
        $sql="select sum(nr_adulti) as adulti,loc_plecare as plecare from migration group by loc_plecare";
        $result=mysqli_query($conn,$sql);
        $nrTotal=0;
        $xml = new DOMDocument();
        while ($row=mysqli_fetch_assoc($result)){
            $info=$xml->createElement('info');
            $data=$xml->createElement('data');
            $data->nodeValue=$row['plecare'];
            $number=$xml->createElement('number');
            $number->nodeValue=$row['adulti'];
            $info->appendChild($number);
            $info->appendChild($data);
            $xml->appendChild($info);
            $xml->save('../app/models/firstChart.xml');
        }

    }
}

?>