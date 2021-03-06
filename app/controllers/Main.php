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
        $sql=$conn->prepare("select * from migration order by data_postare desc");
        $sql->execute();
        $result=$sql->get_result();
        $sql->close();
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
            $latplec=$xml->createElement('lat_plec');
            $latplec->nodeValue=$row['lat_plecare'];
            $lngplec=$xml->createElement('lng_plec');
            $lngplec->nodeValue=$row['lng_plecare'];
            $latdest=$xml->createElement('lat_dest');
            $latdest->nodeValue=$row['lat_destinatie'];
            $lngdest=$xml->createElement('lng_dest');
            $lngdest->nodeValue=$row['lng_destinatie'];
            $post->appendChild($latplec);
            $post->appendChild($lngplec);
            $post->appendChild($latdest);
            $post->appendChild($lngdest);
            $post->appendChild($motiv);
            $post->appendChild($descriere);
            $post->appendChild($dataev);
            $post->appendChild($nr_copii);
            $post->appendChild($nr_adulti);
            $post->appendChild($dest);
            $post->appendChild($plecare);
            $post->appendChild($datapostare);
            $migrations->appendChild( $post );
            $xml->save('../public/xml/migration.xml');

        }



    }
}