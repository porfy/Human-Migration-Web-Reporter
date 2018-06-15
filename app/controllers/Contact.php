<?php
session_start();
class Contact extends Controller{
    public function index()
    {
        $this->view("contact");
    }
}