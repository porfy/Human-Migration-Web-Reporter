<?php
// aici ai controllerul pentru Main

class Main extends Controller {
    public function index(){
        $this->view("main");
    }
}
// in loc de main pui alta pagina.... si cand o sa modifici tot in php
// voiam sa fac static pentru a apela mai usor dar deocamdata lasa asa...deci in controllerul main am facut o functie index
// functia asta nu face decat sa apeleze functia view (implementata in clasa de baza Controller)