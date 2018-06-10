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
Route::set("logout",function (){
    $controller = new Logout();
    $controller ->index();
});

Route::set("export-data",function (){
    $controller = new Exportdata();
    $controller ->index();
});

Route::set("register-submit",function(){
    $controller= new Register();
    $controller->signup();
});
Route::set("login-submit",function(){
    $controller = new Login();
    $controller ->loginf();
});

Route::set("event_submit",function(){
    $controller = new Addevent();
    $controller ->add();
});
    