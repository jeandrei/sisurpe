<?php
 class Buscadadosescolars extends Controller {
    public function __construct(){                
        //isLoggedIn do arquivo session_helper.php
        if(!isLoggedIn()){
        redirect('users/login');
        }
        
        $this->buscadadosescolarsModel = $this->model('Buscadadosescolar');
        $this->anualModel = $this->model('Anual');
        $this->dataModel = $this->model('Datauser');
    }

    
    public function index(){ 
        
        $limit = 10;
        $data = [
            'title' => 'Busca por Dados Anuais',
            'description' => 'Busca por dados inseridos anualmente'          
        ];
      
        /** 
         * IMPORTANTE O MÉTODO DO FORMULÁRIO TEM QUE SER GET
         * E O **NOME DOCAMPO DE BUSCA TEM QUE SER IGUAL AO DO BANCO DE DADOS**
         * verifica a página que está passando se não tiver
         * página no get vai passar pagina 1
         */
        if(isset($_GET['page']))  
        {  
            $page = $_GET['page'];  
        }  
        else  
        {  
            $page = 1;  
        }   
                    
      
        $options = array(
            'results_per_page' => 10,
            'url' => URLROOT . '/buscadadosescolars/index.php?page=*VAR*&ano=' . $_GET['ano'] . '&sexo=' . $_GET['sexo'] . '&escola_id=' . $_GET['escola_id'] . '&etapa_id=' . $_GET['etapa_id'] . '&turno=' . $_GET['turno'] . '&kit_inverno=' . $_GET['kit_inverno']  . '&kit_verao=' . $_GET['kit_verao'] . '&tam_calcado=' . $_GET['tam_calcado'],
            'named_params' => array(                                        
                                        ':escola_id' => $_GET['escola_id'],
                                        ':ano' => $_GET['ano'],
                                        ':sexo' => $_GET['sexo'],
                                        ':kit_inverno' =>$_GET['kit_inverno'],                                        
                                        ':kit_verao' => $_GET['kit_verao'],                                        
                                        ':tam_calcado' => $_GET['tam_calcado'],                                        
                                        ':etapa_id' => $_GET['etapa_id'],
                                        ':turno' => $_GET['turno']
                                    )     
        );
      
        $paginate = $this->buscadadosescolarsModel->getDados($page, $options);

        if($paginate->success == true){             
            // $data['paginate'] é só a parte da paginação tem que passar os dois arraya paginate e result
            $data['paginate'] = $paginate;
            // $result são os dados propriamente dito depois eu fasso um foreach para passar
            // os valores como posição que utilizo um métido para pegar
            $results = $paginate->resultset->fetchAll();         
            
        } 

        $data['results'] =  $results;        
        //FIM PARTE PAGINAÇÃO RETORNANDO O ARRAY $data['paginate']  QUE VAI PARA A VARIÁVEL $paginate DO VIEW NESSE CASO O INDEX

        //SE O BOTÃO CLICADO FOR O IMPRIMIR EU CHAMO A FUNÇÃO getDados($page, $options,1) ONDE 1 É QUE É PARA IMPRIMIR E 0 É PARA LISTAR NA PAGINAÇÃO
        if($_GET['botao'] == "Imprimir"){  
            $data = $this->buscadadosescolarsModel->getDados($page, $options,1);  
            // E AQUI CHAMO O RELATÓRIO          
            $this->view('relatorios/reUniforme' ,$data);
        } else {
            // SE NÃO FOR IMPRIMIR CHAMO O INDEX COM OS DADOS NOVAMENTE
            $this->view('buscadadosescolars/index' ,$data);
        }
    }
    
  
}//class