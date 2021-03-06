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
        //firstchart
        $sql=$conn->prepare("select sum(nr_adulti) as adulti,loc_plecare as plecare from migration group by loc_plecare");
        $sql->execute();
        $result=$sql->get_result();
        $sql->close();
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
            $xml->save('../public/xml/firstChart.xml');
        }
        //second chart
        $sql=$conn->prepare("select count('motiv')as nr,motiv from migration group by motiv ");
        $sql->execute();
        $result=$sql->get_result();
        $sql->close();
        $xml=new DOMDocument();
        $root=$xml->createElement('root');
        $xml->appendChild($root);
        while ($row=mysqli_fetch_assoc($result)){
            $info=$xml->createElement('info');
            $motiv=$xml->createElement('motiv');
            $motiv->nodeValue=$row['motiv'];
            $number=$xml->createElement('number');
            $number->nodeValue=$row['nr'];
            $info->appendChild($motiv);
            $info->appendChild($number);
            $root->appendChild($info);
            $xml->save("../public/xml/secondChart.xml");
        }

        //third chart
        $sql=$conn->prepare("select sum(nr_copii) as copii,dataplecare from migration group by dataplecare");
        $sql->execute();
        $result=$sql->get_result();
        $sql->close();
        $xml=new DOMDocument();
        $root=$xml->createElement('root');
        $xml->appendChild($root);
        while ($row=mysqli_fetch_assoc($result)){
            $info=$xml->createElement('info');
            $nr_copii=$xml->createElement("nr_copii");
            $nr_copii->nodeValue=$row['copii'];
            $date=$xml->createElement('date');
            $date->nodeValue=$row['dataplecare'];
            $info->appendChild($nr_copii);
            $info->appendChild($date);
            $root->appendChild($info);
            $xml->save("../public/xml/thirdChart.xml");
        }

    }
}

?>