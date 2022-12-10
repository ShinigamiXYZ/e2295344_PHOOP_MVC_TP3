<?php



class ModelTrainingType extends Crud {

    protected $table = 'training_type';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'description'];
       /* Boucle et selectionne juste les fillable au cas ou nous aurions plus d'un filed set intégrés* */

}

?>