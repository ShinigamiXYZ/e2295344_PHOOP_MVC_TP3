<?php

    /**
     * Validation
     *
     * Semplice classe PHP per la validazione.(italiano)
     * 
     * 
     * Classe PHP simple pour la validation.(français)
     *
     * @author Davide Cesarano <davide.cesarano@unipegaso.it>
     * @copyright (c) 2016, Davide Cesarano
     * @license https://github.com/davidecesarano/Validation/blob/master/LICENSE MIT License
     * @link https://github.com/davidecesarano/Validation
     * 
     * Traduction et ajustement personnel par : 
     * @author : ShinigamiXYZ
     * @link : https://github.com/ShinigamiXYZ
     * 
     */

    class Validation {

        /**
         * @var array $patterns
         */
        public $patterns = array(
            'uri'           => '[A-Za-z0-9-\/_?&=]+',
            'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
            'alpha'         => '[\p{L}]+',
            'words'         => '[\p{L}\s]+',
            'alphanum'      => '[\p{L}0-9]+',
            'int'           => '[0-9]+',
            'float'         => '[0-9\.,]+',
            'tel'           => '[0-9+\s()-]+',
            'text'          => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
            'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
            'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
            'address'       => '[\p{L}0-9\s.,()°-]+',
            'date_dmy'      => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
            'date_ymd'      => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
            'email'         => '[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})'
        );

        /**
         * @var array $errors
         */
        public $errors = array();

        /**
         * Nom du champ
         *
         * @param string $name
         * @return this
         */
        public function name($name){

            $this->name = $name;
            return $this;

        }

        /**
         * Valeur du champ
         *
         * @param mixed $value
         * @return this
         */
        public function value($value){

            $this->value = $value;
            return $this;

        }

        /**
         * File
         *
         * @param mixed $value
         * @return this
         */
        public function file($value){

            $this->file = $value;
            return $this;

        }

        /**
         * Modèle à appliquer à la reconnaissance de l'expression régulière
         *
         * @param string $name nom du modèle(pattern)
         * @return this
         */
        public function pattern($name){

            if($name == 'array'){

                if(!is_array($this->value)){
                    $this->errors[] = 'Le format du champ '.$this->name.' n\'est pas valide.';
                }

            }else{

                $regex = '/^('.$this->patterns[$name].')$/u';
                if($this->value != '' && !preg_match($regex, $this->value)){
                    $this->errors[] = 'Le format du champ '.$this->name.' n\'est pas valide.';
                }

            }
            return $this;

        }

        /**
         * (Pattern) Modèle personnalisé
         *
         * @param string $pattern
         * @return this
         */
        public function customPattern($pattern){

            $regex = '/^('.$pattern.')$/u';
            if($this->value != '' && !preg_match($regex, $this->value)){
                $this->errors[] = 'Le format du champ '.$this->name.' n\'est pas valide.';
            }
            return $this;

        }

        /**
         * Champs obligatoire
         *
         * @return this
         */
        public function required(){

            if((isset($this->file) && $this->file['error'] == 4) || ($this->value == '' || $this->value == null)){
                $this->errors[] = 'Le champ '.$this->name.' est obligatoire.';
            }
            return $this;

        }

        /**
         *Longueur minimale
        * de la valeur du champ
         *
         * @param int $min
         * @return this
         */
        public function min($length){

            if(is_string($this->value)){

                if(strlen($this->value) < $length){
                    $this->errors[] = 'La valeur du champ '.$this->name.' est inférieur à la valeur minimale';
                }

            }else{

                if($this->value < $length){
                    $this->errors[] = 'La valeur du champ '.$this->name.' est inférieur à la valeur minimale';
                }

            }
            return $this;

        }

        /**
         *Longueur maximale
        * de la valeur du champ
         *
         *
         * @param int $max
         * @return this
         */
        public function max($length){

            if(is_string($this->value)){

                if(strlen($this->value) > $length){
                    $this->errors[] = 'La valeur du champ '.$this->name.' est supérieur à la valeur maximale';
                }

            }else{

                if($this->value > $length){
                    $this->errors[] = 'La valeur du champ '.$this->name.' est supérieur à la valeur maximale';
                }

            }
            return $this;

        }

        /**
         *Comparez avec la valeur d'un autre champs
         *
         * @param mixed $value
         * @return this
         */
        public function equal($value){

            if($this->value != $value){
                $this->errors[] = 'La valeur du champ '.$this->name.' ne correspond pas.';
            }
            return $this;

        }

        /**
         * Dimension maximale du fichier.
         *
         * @param int $size
         * @return this
         */
        public function maxSize($size){

            if($this->file['error'] != 4 && $this->file['size'] > $size){
                $this->errors[] = 'Le fichier'.$this->name.' dépasse la taille maximale de '.number_format($size / 1048576, 2).' MB.';
            }
            return $this;

        }

        /**
         * 
        * Extension de fichier (format).
         *
         * @param string $extension
         * @return this
         */
        public function ext($extension){

            if($this->file['error'] != 4 && pathinfo($this->file['name'], PATHINFO_EXTENSION) != $extension && strtoupper(pathinfo($this->file['name'], PATHINFO_EXTENSION)) != $extension){
                $this->errors[] = 'Il file '.$this->name.' non è un '.$extension.'.';
            }
            return $this;

        }

        /**
         * Purifier pour prévenir les attaques XSS
         *
         * @param string $string
         * @return $string
         */
        public function purify($string){
            return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        }

        /**
         * Champs validés
         *
         * @return boolean
         */
        public function isSuccess(){
            if(empty($this->errors)) return true;
        }

        /**
         * Erreurs de validation
         *
         * @return array $this->errors
         */
        public function getErrors(){
            if(!$this->isSuccess()) return $this->errors;
        }

        /**
         * Afficher les erreurs au format Html
         *
         * @return string $html
         */
        public function displayErrors(){

            $html = '';
                foreach($this->getErrors() as $error){
                    $html .= '<p>'.$error.'</p>';
                }
           /* Modification -> tag <p> au lieu de la structure ul/li* */

            return $html;

        }

        /**
         * Afficher le résultat de la validation
         *
         * @return booelan|string
         */
        public function result(){

            if(!$this->isSuccess()){

                foreach($this->getErrors() as $error){
                    echo "$error\n";
                }
                exit;

            }else{
                return true;
            }

        }

        /**
         * Vérifiez si la valeur est
          *un nombre entier
         *
         * @param mixed $value
         * @return boolean
         */
        public static function is_int($value){
            if(filter_var($value, FILTER_VALIDATE_INT)) return true;
        }

        /**
        * Vérifiez si la valeur est
          *un nombre float
         *
         * @param mixed $value
         * @return boolean
         */
        public static function is_float($value){
            if(filter_var($value, FILTER_VALIDATE_FLOAT)) return true;
        }

        /**
         * Vérifiez si la valeur est
          *une lettre de l'alphabet
         *
         * @param mixed $value
         * @return boolean
         */
        public static function is_alpha($value){
            if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-zA-Z]+$/")))) return true;
        }

        /**
        * Vérifiez si la valeur est
         * une lettre ou un chiffre
         *
         * @param mixed $value
         * @return boolean
         */
        public static function is_alphanum($value){
            if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-zA-Z0-9]+$/")))) return true;
        }

        /**
       * Vérifie si la valeur est
         * une URL
         *
         * @param mixed $value
         * @return boolean
         */
        public static function is_url($value){
            if(filter_var($value, FILTER_VALIDATE_URL)) return true;
        }

        /**
         * Vérifie si la valeur est
         * un uri
         *
         * @param mixed $value
         * @return boolean
         */
        public static function is_uri($value){
            if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[A-Za-z0-9-\/_]+$/")))) return true;
        }

        /**
         * Vérifiez si la valeur est
         * vrai ou faux
         * BOOLEAN
         *
         * @param mixed $value
         * @return boolean
         */
        public static function is_bool($value){
            if(is_bool(filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE))) return true;
        }

        /**
        * Vérifiez si la valeur est
         * un email
         *
         * @param mixed $value
         * @return boolean
         */
        public static function is_email($value){
            if(filter_var($value, FILTER_VALIDATE_EMAIL)) return true;
        }

    }
