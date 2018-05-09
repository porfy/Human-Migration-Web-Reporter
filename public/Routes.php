<?php

// fisierul asta tine minte toate rutele pe care le ai ... prin o simpla functie

Route::set("main",function(){
    $controller = new Main();
    $controller->index();
});

Route::set("intro",function (){
    $controller = new Intro();
    $controller->index();
});

Route::set("login",function (){
    $controller = new Login();
    $controller->index();
});

Route::set("register",function (){
    $controller = new Register();
    $controller->index();
});

Route::set("contact",function (){
    $contorller = new Contact();
    $contorller ->index();
});

Route::set("user",function(){
    $controller = new User();
    $controller ->index();
});

Route::set("add-event",function (){
    $controller = new Addevent();
    $controller -> index();
});

Route::set("export-data",function (){
    $controller = new Exportdata();
    $controller ->index();
});
    // sper ca vezi ca funtion aia e o functie pe care o scrii aici direct da se observa
// aici pur si simplu apelezi functia set avand ca parametri numele rutei (aici main) si o functie... functia aia reprezinta ce vrei
// tu sa faci cand ai accesat o anumita ruta

// ai serverul pronit?
// nu stiu cum ai setat tu in config.... stai o sec
// am dat rau pathul catre main.html...
// aici... cum e aia doar ca difera ce controller creezi
//alta pagina alt controller... deocamdata controllerele sunt la fel ... difera doar parametrul