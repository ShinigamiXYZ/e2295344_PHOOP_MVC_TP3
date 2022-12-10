<?php
RequirePage::requireModel('ModelLogBook');
class ModelUser extends Crud {

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'nom', 'adresse', 'password', 'email', 'membership_id', 'user_type_id'];
    /* Boucle et selectionne juste les fillable au cas ou nous aurions plus d'un filed set intégrés* */

    public function checkUser($data){
        extract($data);
     
        $sql = "SELECT * FROM $this->table WHERE email = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($email));
        $count = $stmt->rowCount();
      
      if ($count == 1){
            $user_info = $stmt->fetch();
            if(password_verify($password, $user_info['password'])){
                    
                session_regenerate_id();
                $_SESSION['user_id'] = $user_info['id'];
                $_SESSION['email'] = $user_info['email'];
                $_SESSION['privilege_id'] = $user_info['user_type_id'];
                $_SESSION['user_name'] = $user_info['nom'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
               
                /**
                 * 
                 * Pris sur -> https://stackoverflow.com/questions/3003145/how-to-get-the-client-ip-address-in-php
                 */
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $_SESSION['ip_adress'] = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $_SESSION['ip_adress'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $_SESSION['ip_adress'] = $_SERVER['REMOTE_ADDR'];
                }

                $_SESSION['login_time'] =  date('Y/m/d H:i:s',$_SERVER['REQUEST_TIME']);

                /* TRANSFERER LE TOUT DANS UNE DB -> LOGBOOK* */
                $logEntry  = new ModelLogBook;
                $dataLog = $logEntry -> insert($_SESSION);
                
                requirePage::redirectPage('../',['user_info' => $user_info]);
                
            }else{
               return "<p> Mot de passe incorrect </p>";  
            }
        }else{
            return "<p> Aucun usagé correspondant </p>";
        }
    } 


  /*   public function checkUnique($data){
        extract($data);
     
        $sql = "SELECT * FROM $this->table WHERE email = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($email));
        $count = $stmt->rowCount();

        if($count>1){

            $unique = false;
        }
        else if($count == 1){
            $unique = false;
        }

        return $unique;
} */
}
?>