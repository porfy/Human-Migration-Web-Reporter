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
        $sql=$conn->prepare("select sum(nr_adulti) as adulti,loc_plecare as plecare from migration group by loc_plecare");
        $sql->execute();
        $result=$sql->get_result();
        $sql->close();
        $nrTotal=0;
        $xml = new DOMDocument();
        $root=$xml->createElement('root');
        $xml->appendChild($root);
        while ($row=mysqli_fetch_assoc($result)){
            $info=$xml->createElement('info');
            $data=$xml->createElement('data');
            $data->nodeValue=$row['plecare'];
            $number=$xml->createElement('number');
            $number->nodeValue=$row['adulti'];
            $info->appendChild($number);
            $info->appendChild($data);
            $root->appendChild($info);
            $xml->save('../app/models/firstChart.xml');
        }

    }
}

?>