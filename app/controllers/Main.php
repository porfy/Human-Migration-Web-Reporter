<?php

class Main extends Controller
{
    public function index()
    {
        $this->view("main");
    }


    public function feed()
    {
        require_once ('../app/models/Database.php');
        $xml = new DOMDocument();
        $conn=Database::getConection();
        $sql="select * from migration order by data_postare desc";
        $result=mysqli_query($conn,$sql);
        $migrations=$xml->createElement('migration');
        $xml->appendChild($migrations);
        while ($row = mysqli_fetch_assoc($result)){
            $post = $xml->createElement( 'post' );
            $datapostare= $xml->createElement("datapos");
            $datapostare->nodeValue=$row["data_postare"];
            $plecare= $xml->createElement("loc_plecare");
            $plecare->nodeValue=$row['loc_plecare'];
            $dest=$xml->createElement("loc_destinatie");
            $dest->nodeValue=$row['loc_destinatie'];
            $nr_adulti=$xml->createElement("nr_adulti");
            $nr_adulti->nodeValue=$row['nr_adulti'];
            $nr_copii=$xml->createElement("nr_copii");
            $nr_copii->nodeValue=$row['nr_copii'];
            $dataev=$xml->createElement('dataplecare');
            $dataev->nodeValue=$row['dataplecare'];
            $descriere=$xml->createElement('descriere');
            $descriere->nodeValue=$row['descriere'];
            $motiv=$xml->createElement('motiv');
            $motiv->nodeValue=$row['motiv'];
            $post->appendChild($motiv);
            $post->appendChild($descriere);
            $post->appendChild($dataev);
            $post->appendChild($nr_copii);
            $post->appendChild($nr_adulti);
            $post->appendChild($dest);
            $post->appendChild($plecare);
            $post->appendChild($datapostare);
            $migrations->appendChild( $post );
            $xml->save('../app/models/migration.xml');

        }



    }
}