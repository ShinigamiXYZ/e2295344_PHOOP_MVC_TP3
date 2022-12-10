<?php

class ControllerHome{

    public function index(){

      twig::render("home-index.php");

    }

    public function error(){
        twig::render("home-error.php");
    }
}