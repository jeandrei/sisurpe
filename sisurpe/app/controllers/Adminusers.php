<?php 
    class Adminusers extends Controller{

        public function __construct(){
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            $this->adminuserModel = $this->model('Adminuser');
        }     

    public function index(){ 
        
        $limit = 10;
        $data = [
            'title' => 'Busca por Usuários',
            'description' => 'Busca por registros de Usuários'          
        ]; 

        // INÍCIO PARTE PAGINAÇÃO SÓ COPIAR ESSA PARTE MUDAR A URL E COLOCAR OS PARAMETROS EM named_params
        // O STATUS EU NÃO PASSO PARA O A CONSULTA É APENAS PARA MANTER AS INFORMAÇÕES APÓS CLICAR NO LINK DA PAGINAÇÃO
        // CASO CONTRÁRIO TODA VEZ QUE CLICASSE NO LINK DA PAGINAÇÃO ELE VOLTA PARA O VALOR PADRÃO DO CAMPO DE BUSCA
        if(isset($_GET['page']))
        {
            //ENTRA AQUI SE FOR CLICADO PELO LINK DA PAGINAÇÃO
            $page = $_GET['page'];          
            
            $name =$_GET['name'];        
            $_POST['name'] =  $name;         
            
        }
        else
        {           
            // SE ENTROU AQUI É QUE FOI CARREGADO A PÁGINA PELA PRIMEIRA VEZ OU FOI CLICADO EM ATUALIZAR
            // LOGO SE TENHO ALGUM VALOR NO POST DE BUSCA PASSO PARA A VARIÁVEL STATUS E POR FIM SE AINDA ASSIM 
            //A VARIÁVEL ESTIVER VAZIA PASSO O VALOR PADRÃO 'Todos'
            $name = $_POST['name'];  

            $page = 1;
        }      
                  
        $options = array(
          'results_per_page' => 10,
          'url' => URLROOT . '/adminusers/index.php?page=*VAR*&name=' . $name,
          'named_params' => array(
                                    ':name' => $name
                                )     
        );
      
        $paginate = $this->adminuserModel->getUsers($page, $options); 
              
        if($paginate->success == true) 
        {            
            // $data['paginate'] é só a parte da paginação tem que passar os dois arraya paginate e result
            $data['paginate'] = $paginate;
            // $result são os dados propriamente dito depois eu fasso um foreach para passar
            // os valores como posição que utilizo um métido para pegar
            $results = $paginate->resultset->fetchAll();  
        }   
      
        $data['results'] =  $results;        
        //FIM PARTE PAGINAÇÃO RETORNANDO O ARRAY $data['paginate']  QUE VAI PARA A VARIÁVEL $paginate DO VIEW NESSE CASO O INDEX
        
      
        $this->view('adminusers/index', $data);
    }


    //aqui é o método chamado pelo jquery lá no index, verifico se o id tem algum valor se sim eu chamo o método changeStatus no model
    public function atualizatype(){

        try{ 
                
          // DEPOIS TEM QUE TIRAR ESSE 1 AÍ DA FRENTE E COLOCAR A VARIÁVEL POST COM O ID DO MUNICIPIO
          // IMPORTANTE lá na função changeStatus se executar tem que retornar true para funcionar aqui
          
          if($this->adminuserModel->update($_POST['id'],$_POST['type'])){
              
              
              /* aqui passo a classe da mensagem e a mensagem de sucesso */
              $json_ret = array('classe'=>'alert alert-success', 'mensagem'=>'Dados gravados com sucesso');                     
              echo json_encode($json_ret);                     
          } else {
              $json_ret = array('classe'=>'alert alert-danger', 'mensagem'=>'Erro ao tentar gravar os dados');                     
              echo json_encode($json_ret);                     
          }                

      } catch (Exception $e) 
      {
          $json_ret = array('classe'=>'alert alert-danger', 'mensagem'=>'Erro ao gravar os dados');                     
          echo json_encode($json_ret);
      } 
   
  }


}   
?>