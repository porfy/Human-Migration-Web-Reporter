<?php

class Controller
{
    public function index()
    {
        echo 'home/intro';
    }

    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}