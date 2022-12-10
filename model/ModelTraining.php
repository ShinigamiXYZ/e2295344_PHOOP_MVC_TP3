<?php



class ModelTraining extends Crud {

    protected $table = 'training';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'description', 'training_type_id'];
       /* Boucle et selectionne juste les fillable au cas ou nous aurions plus d'un filed set intégrés* */

}

?>