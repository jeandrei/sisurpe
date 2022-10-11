<?php 
    class Modelos extends Controller{
        public function __construct(){
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            $this->userModel = $this->model('Modelo');
        }    
        
        public function paginamodelo($page=0){

                      //busca os dados no banco id_pag a partir de onde inicia , 5 quntidade de resultados por pagina
                      $pessoas = $this->userModel->getPessoas($page,5);
                     
                      $data = [
                        'pessoas' => $pessoas
                    ];                    
                                       
                      $this->view('modelos/paginamodelo', $data);
                    }               

            
} 
    
    
   
?>