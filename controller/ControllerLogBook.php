<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelUser');
RequirePage::requireModel('ModelTraining');
RequirePage::requireModel('ModelTrainingType');
RequirePage::requireModel('ModelMembership');
RequirePage::requireModel('ModelUserType');


class ControllerLogBook{

    public function index(){

        $entries = new ModelLogBook;
        $logbook = $entries->select();
       
        twig::render("logbook.php", ['entries' => $logbook]);
    }

    public function store(){
       
        $logBook = new ModelLogBook;
        $insert = $logBook ->insert($_SESSION);
       }
}


?>