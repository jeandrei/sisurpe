<?php
/*
* App core Class
* Creates URL & loads core controller
* URL FORMAT - /controller/method/params
 */

 Class Core {
     protected $currentController = 'Pages';
     protected $currentMethod = 'index';
     protected $params = [];

     public function __construct(){
         //print_r($this->getUrl());
         $url = $this->getUrl();

         // Look in controller for first value
         // verificamos se o controller existe dentro da pasta app/controllers
         if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
            //if existe, set as a controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 index
            unset($url[0]);
         }
         
         // Require the controller
         require_once '../app/controllers/' . $this->currentController . '.php';

         // Instantiate controller class
         // o que vai acontecer aqui é instanciar o controller
         // exemplo $pages = new Pages;
         $this->currentController = new $this->currentController;

         // Check for second part of url
         if(isset($url[1])){
           // Check to see if the method exist in the controller
           if(method_exists($this->currentController, $url[1])){
             $this->currentMethod = $url[1];
             // Unset 0 index
             unset($url[1]);
           }
         }

         // Get params
         // se tiver valor na url ele passa para a propriedade
         // params caso contrário passa um array vazio
         $this->params = $url ? array_values($url) :[];

         

         /* Call a callback with array of params
         * cunção call_user_func_array chama a classe e o método da classe
         * exemplo imagine uma classe User com o método getUsers($idade,$sexo);
         * $user = new User;
         * call_user_func_array($user, "getUsers"), array("20", "Masculino"));
         */
         call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
     }

     public function getUrl(){
        if(isset($_GET['url'])){
          $url = rtrim($_GET['url'], '/');
          //valida a url FILTER_SANITIZE_URL não deixa passar
          // nenhum caractere que uma url não deve ter 
          $url = filter_var($url, FILTER_SANITIZE_URL);
          //quebramos a url em um array
          $url = explode('/', $url);
          return $url;
        }
     }
 }
