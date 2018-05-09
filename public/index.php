<?php

require_once 'Routes.php';

function __autoload($class_name){
    if(file_exists('../app/core/' . $class_name . '.php')){
        require_once '../app/core/' . $class_name . '.php';
    }
    else if (file_exists('../app/controllers/' . $class_name . '.php')){
        require_once '../app/controllers/' . $class_name . '.php';
    }
}

// functia autoload incearca sa incarce o clasa atunci cand php ar trebui sa arunce o eroare cum ca nu stie o anumita clasa... iti explic mai bine acasa...
//