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
      
        if(isset($_GET['page'])){
            
            //ENTRA AQUI SE FOR CLICADO PELO LINK DA PAGINAÇÃO
            $page = $_GET['page'];             
            
            $nome =$_GET['buscanome'];
            $_POST['buscanome'] =  $nome;

            $escola_id =$_GET['escola_id'];
            $_POST['escola_id'] =  $escola_id;

            $ano =$_GET['ano'];
            $_POST['ano'] =  $ano;

            $sexo =$_GET['sexo'];
            $_POST['sexo'] =  $sexo;

            $kit_inverno =$_GET['kit_inverno'];
            $_POST['kit_inverno'] =  $kit_inverno;

            $kit_verao =$_GET['kit_verao'];
            $_POST['kit_verao'] =  $kit_verao;
            
            $tam_calcado =$_GET['tam_calcado'];
            $_POST['tam_calcado'] =  $tam_calcado;
           
            $etapa_id =$_GET['etapa_id'];
            $_POST['etapa_id'] =  $etapa_id;

            $turno =$_GET['turno'];
            $_POST['turno'] =  $turno;
            
        }
        else
        {           
            // SE ENTROU AQUI É QUE FOI CARREGADO A PÁGINA PELA PRIMEIRA VEZ OU FOI CLICADO EM ATUALIZAR
            // LOGO SE TENHO ALGUM VALOR NO POST DE BUSCA PASSO PARA A VARIÁVEL STATUS E POR FIM SE AINDA ASSIM 
            //A VARIÁVEL ESTIVER VAZIA PASSO O VALOR PADRÃO 'Todos'
            $nome = $_POST['buscanome'];
            $escola_id = $_POST['escola_id'];
            $ano = $_POST['ano'];
            $sexo = $_POST['sexo'];
            $kit_inverno = $_POST['kit_inverno'];            
            $kit_verao = $_POST['kit_verao'];            
            $tam_calcado = $_POST['tam_calcado'];            
            $etapa_id = $_POST['etapa_id'];
            $turno = $_POST['turno']; 

            $page = 1;
        }     
      
        $options = array(
            'results_per_page' => 10,
            'url' => URLROOT . '/buscadadosescolars/index.php?page=*VAR*&nome=' . $nome . '&ano=' . $ano . '&sexo=' . $sexo . '&escola_id=' . $escola_id . '&etapa_id=' . $etapa_id . '&turno=' . $turno . '&kit_inverno=' . $kit_inverno  . '&kit_verao=' . $kit_verao . '&tam_calcado=' . $tam_calcado,
            'named_params' => array(
                                        ':nome' => $nome,
                                        ':escola_id' => $escola_id,
                                        ':ano' => $ano,
                                        ':sexo' => $sexo,
                                        ':kit_inverno' => $kit_inverno,                                        
                                        ':kit_verao' => $kit_verao,                                        
                                        ':tam_calcado' => $tam_calcado,                                        
                                        ':etapa_id' => $etapa_id,
                                        ':turno' => $turno
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
        if($_POST['botao'] == "Imprimir"){  
            $data = $this->buscadadosescolarsModel->getDados($page, $options,1);  
            // E AQUI CHAMO O RELATÓRIO          
            $this->view('relatorios/reUniforme' ,$data);
        } else {
            // SE NÃO FOR IMPRIMIR CHAMO O INDEX COM OS DADOS NOVAMENTE
            $this->view('buscadadosescolars/index' ,$data);
        }
    }
    
  
}//class