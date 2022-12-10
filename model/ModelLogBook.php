<?php

class ModelLogBook extends Crud {

    protected $table = 'logbook';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'user_id', 'user_name', 'fingerPrint','ip_adress', 'login_time'];
    /* Boucle et selectionne juste les fillable au cas ou nous aurions plus d'un filed set intégrés* */

    
}

?>