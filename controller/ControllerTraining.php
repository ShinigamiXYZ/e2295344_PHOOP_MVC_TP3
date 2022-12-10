<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelUser');
RequirePage::requireModel('ModelUserType');
RequirePage::requireModel('ModelTraining');
RequirePage::requireModel('ModelTrainingType');



class ControllerTraining{

    public function index(){
        if($_SESSION){
           
        $training = new Modeltraining;
        $trainingType = new ModelTrainingType;
        $select = $training->select();
        $selectTrainingType = $trainingType->select();
        twig::render("training-index.php", ['training' => $select, 'trainingType' => $selectTrainingType]);}
        else{
            twig::render("home-error.php");
        }
    }

    public function create(){
        if($_SESSION){
            if($_SESSION['privilege_id'] == 1 || $_SESSION['privilege_id'] == 3){
                twig::render('training-create.php');
            }
            
            else{
                twig::render("home-error.php");
            }
          
             }
        else{
            twig::render("home-error.php");
        }
    }

    public function store(){
     // print_r($_POST);
     
     $training = new Modeltraining;
     $insert = $training->insert($_POST);
     

    RequirePage::redirectPage('../training'); /* A remanier .. pk path dont work?* */
    }

    public function show($id){
        $training = new Modeltraining;
        $trainingType = new ModelTrainingType;
        $selecttraining = $training->selectId($id);
        $selectTrainingType = $trainingType->select();
        twig::render('training-show.php', ['training' => $selecttraining, 'trainingType' => $selectTrainingType]);
    }

    public function edit($id){
        $training = new Modeltraining;
        $trainingType = new ModelTrainingType;
        $selecttraining = $training->selectId($id);
        $selectTrainingType = $trainingType->select();
        twig::render('training-edit.php', ['training' => $selecttraining, 'trainingType' => $selectTrainingType]);
    }

    public function update(){
        $training = new Modeltraining;
        $update = $training->update($_POST);
        RequirePage::redirectPage('../training');
    }
    public function delete(){
        $training = new Modeltraining;
        $delete = $training->delete($_POST['id']);
        RequirePage::redirectPage('../training'); /*  A VOIR * */
    }
}
?>