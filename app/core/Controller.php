<?php

class Controller{
    public function index(){
        echo 'home/intro';
    }

    public function view($view, $data = []){
        require_once '../app/views/' . $view . '.html';
    }
    // functia view nu face decat sa ceara o anumita pagina... adica sa o afiseze gen... tu le ai taote html asa ca le las asa deocamdata
}
// modifici si .html ala in .php
// incearca sa adaugi alte controllere/pagini
// sa ai grija ca trebuie sa modifici href-urile din html-uri... cel putin eu a trebuit sa o fac
