<?php

class ModelMembership extends Crud {

    protected $table = 'membership';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'membership'];
    /* Boucle et selectionne juste les fillable au cas ou nous aurions plus d'un filed set intégrés* */

    
}

?>