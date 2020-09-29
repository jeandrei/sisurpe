<?php
// inclue os métodos para ler models e views
/*
* Base Controller
* Load the models and views
* Temos acesso a esta classe controller pois a mesma está sendo
* requerida no arquivo bootstrap.php que é requerido pelo index
 */

 class Controller{
     // Load model
     public function model($model){
        // Require model file
        require_once('../app/models/' . $model . '.php');

        // Instantiate the model like return new Post();
        return new $model();
     }

     // Load view
     public function view($view, $data = []){
        // Check for view file
        if(file_exists('../app/views/' . $view . '.php')){
           require_once '../app/views/' . $view . '.php'; 
        } else {
            die('View não existe');
        }
     }
 }