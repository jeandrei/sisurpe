<?php
    
    // Load Session
    require_once 'helpers/session_helper.php';
    // Load Config
    require_once 'config/config.php';
   
    // Load Helpers    
    require_once 'helpers/helpers.php';
    
    require_once 'helpers/functions.php';
    
    

    /* Autoload Core Libraries
     Le tudo o que está na pasta libraries
     Para funcionar o nome do arquivo tem que ser igual ao 
     nome da classe
     Exemplo se tenho uma classe chamada Database
     para ler automaticamente o aqruivo dentro de libraries
     tem que ser Database.php igual inclusive a letra maiúscula
    */
    spl_autoload_register(function($className){
        require_once 'libraries/'. $className . '.php';
    });
