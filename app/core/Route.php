<?php

class Route{
    public static $validRoutes = array();

    public static function set($route, $function){
        self::$validRoutes[] = $route;

        $url = 'main';

        if(isset($_GET['url'])){
            $url=$_GET['url'];
        }

        if($url==$route){
            $function->__invoke();
        }
    }
}
// in functie
// de unde muti root-ul din config trebuie sa modifici si chestii din ce ai pe aici... cel putin eu asa am patit
//la ce te refrri
//nu stiu exact cum functioneaza fisierele astea... dar eu daca modific chestia aia in config la server am numai probleme
//si vad ca si la tine s-a facut reload-ul destul de ciudat
// gata stiu ce are.... e din cauza la htaccess
// deci.... valid routes o sa contina toate rutele pe care le ai tu... sunt adaugate acolo in prima linie din set
// apoi verificam variabila 'url' care stie ce url ai accesat tu si daca url=$route care e numele rutei atunci apeleaza functia