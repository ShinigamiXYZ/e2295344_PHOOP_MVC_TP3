<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelUser');
RequirePage::requireModel('ModelTraining');
RequirePage::requireModel('ModelTrainingType');
RequirePage::requireModel('ModelMembership');
RequirePage::requireModel('ModelUserType');


class ControllerUser{

    public function index(){

        if($_SESSION){
         
        $user = new ModelUser;
        $membership = new ModelMembership;
        $userType = new ModelUserType;
        $select = $user->select();
        $selectMembership = $membership->select();
        $selectUserType = $userType->select();
        twig::render("user-index.php", ['user' => $select, 
                                        'membership' => $selectMembership, 'userType' => $selectUserType  ]);
        }else{
                                            twig::render("home-error.php");
                                        }
                                }


    public function create(){
       twig::render('user-create.php');
    }

    public function store(){
     /* // print_r($_POST); */


     
     $validation = new Validation;


     extract($_POST);
     RequirePage::requireModel('ModelMail');
   
     $validation->name('nom')->value($nom)->pattern('alpha')->required()->max(45);
     $validation->name('email')->value($email)->pattern('email')->required()->max(50);
     $validation->name('password')->value($password)->max(20)->min(6);
        



     if($validation->isSuccess()){
         $user = new ModelUser;
         $options = [
             'cost' => 10,
         ];
         $_POST['password']= password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
         $userInsert = $user->insert($_POST);

         
     RequirePage::requireModel('ModelMail');
     $mail = new ModelMail;
    $sendMail = $mail->SendEmail($_POST);

         RequirePage::redirectPage('../user/login');
     }else{
         $errors = $validation->displayErrors();
         $privilege = new ModelUserType;
         $selectPrivilege = $privilege->select();
         twig::render('user-create.php', ['errors' => $errors,'privileges' => $selectPrivilege, 'user' => $_POST]);
     }
    
    }

    public function show($id){
        $user = new ModelUser;
        $selectUser = $user->selectId($id);
        twig::render('user-show.php', ['user' => $selectUser]);
    }

    public function edit($id){
        $user = new ModelUser;
        $membership = new ModelMembership;
        $selectUser = $user->selectId($id);
        $selectMembership = $membership->select();
        twig::render('user-edit.php', ['user' => $selectUser, 'membership' => $selectMembership]);
    }

    public function update(){
        $user = new ModelUser;
        $update = $user->update($_POST);
        RequirePage::redirectPage('../user');
    }
    public function delete(){
        $user = new ModelUser;
        $delete = $user->delete($_POST['id']);
        RequirePage::redirectPage('../user'); /*  A VOIR * */
    }
    public function login(){
        twig::render('user-login.php');
    }

    public function auth(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('username')->value($email)->pattern('email')->required()->max(50);
        $validation->name('password')->value($password)->required();

        if($validation->isSuccess()){

            $user = new ModelUser;
            $checkUser = $user->checkUser($_POST);
          
            
            twig::render('user-login.php', ['errors' => $checkUser, 'user' => $_POST]);
        
        }else{
            $errors = $validation->displayErrors();
            twig::render('user-login.php', ['errors' => $errors, 'user' => $_POST]);
        }
    }

    public function logoutt(){
        session_destroy();
        RequirePage::redirectPage('../'); /*  A VOIR * */
    }
}
