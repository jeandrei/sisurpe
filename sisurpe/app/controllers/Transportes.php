<?php
  class Transportes extends Controller {
      
    public function __construct(){                
      //isLoggedIn do arquivo session_helper.php
      if(!isLoggedIn()){
        redirect('users/login');
      }       
      $this->transporteModel = $this->model('Transporte');    
    }

      
    public function index($id){

    $data = [
      'aluno_id' => $id
    ];
          
    $this->view('transportes/index', $data);
    } 



    public function gravar($id){     
                
      if($_SERVER['REQUEST_METHOD'] == 'POST'){  
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);      
      
        $data = [              
          'aluno_id' => $id,
          'linha' => $_POST['linha']
        ];

        if(($data['linha'])=="NULL"){
          $data['linha_err'] = 'Por favor informe a linha';
        } 

        if($this->transporteModel->checkAlunoLinha($data['aluno_id'], $data['linha'])){
          $data['linha_err'] = 'Linha já adicionada';
        }

        // Make sure errors are empty
        if(                    
        empty($data['linha_err']) 
        ){

            try {
              if($this->transporteModel->register($data)){                         
                flash('mensagem', 'Dados registrados com sucesso');                     
                redirect('transportes/index/'.$id);
              }                 
            } catch (Exception $e) {
              die('Ops! Algo deu errado.');  
            } 
        
        } else {
          // Load the view with errors
          $this->view('transportes/index', $data);
        } 
      } else {
        $this->view('transportes/index', $data);
      }      
  }



    public function delete($id){
        
      //pego o id do usuário que registrou esse aluno
      $dados = $this->transporteModel->getDadosAlunoLinha($id);   
      // se for o mesmo id do usuário logado eu permito a exclusão caso contrário bloqueio
      //echo $dados->$aluno_id;
      if($dados->user_id != $_SESSION[DB_NAME . '_user_id']){            
        die("Você não tem permissão para excluir este aluno");
      }

      try {
        if($this->transporteModel->deleteAlunoLinhas($id)){                       
          flash('mensagem', 'Registro removido com sucesso!');                
          redirect("transportes/index/". $dados->aluno_id);
        } else {
          flash('mensagem', 'Falha ao tentar remover o registro', 'alert alert-danger');
          redirect("transportes/index/". $dados->aluno_id);
        }                
      } catch (Exception $e) {
        die('Ops! Algo deu errado.');  
      } 
        
    }  
    
  }//class