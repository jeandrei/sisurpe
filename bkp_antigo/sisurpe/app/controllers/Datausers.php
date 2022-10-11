<?php
 class Datausers extends Controller {

    public function __construct(){                
        //isLoggedIn do arquivo session_helper.php
        if(!isLoggedIn()){
          redirect('users/login');
        }
       
     $this->dataModel = $this->model('Datauser');
     $this->dadosModel = $this->model('Anual');
     $this->transporteModel = $this->model('Transporte');   
    
    }
    
    public function index(){
      $datauser = $this->dataModel->getDatauserByid($_SESSION['aluno_id']); 
      $data = [
          'aluno_id' => $datauser->aluno_id,
          'nome_aluno' => mb_mb_strtoupper($datauser->nome_aluno),
          'nascimento' => $datauser->nascimento,
          'sexo' => $datauser->sexo,
          'telefone_aluno' => $datauser->telefone_aluno,
          'email_aluno' => $datauser->email_aluno,
          'nome_pai' => mb_strtoupper($datauser->nome_pai),
          'telefone_pai' => $datauser->telefone_pai,
          'nome_mae' => mb_strtoupper($datauser->nome_mae),
          'telefone_mae' => $datauser->telefone_mae,
          'nome_responsavel' => mb_strtoupper($datauser->nome_responsavel),
          'telefone_resp' => $datauser->telefone_resp,
          'naturalidade' => mb_strtoupper($datauser->naturalidade), 
          'nacionalidade' => mb_strtoupper($datauser->nacionalidade), 
          'end_rua' => mb_strtoupper($datauser->end_rua), 
          'end_numero' => $datauser->end_numero, 
          'end_bairro_id' => $datauser->end_bairro_id,
          'rg' => $datauser->rg, 
          'uf_rg' => $datauser->uf_rg,
          'orgao_emissor' => mb_strtoupper($datauser->orgao_emissor),
          'titulo_eleitor' => $datauser->titulo_eleitor,
          'zona' => $datauser->zona,
          'secao' => $datauser->secao,
          'certidao' => mb_strtoupper($datauser->certidao),
          'uf_cert' => $datauser->uf_cert,
          'cartorio_cert' => mb_strtoupper($datauser->cartorio_cert),
          'modelo' => $datauser->modelo,
          'numero' => $datauser->numero, 
          'folha' => $datauser->folha,
          'livro' => $datauser->livro,
          'data_emissao_cert' => $datauser->data_emissao_cert,
          'municipio_cert' => mb_strtoupper($datauser->municipio_cert),
          'cpf' => $datauser->cpf,
          'tipo_sanguineo' => mb_strtoupper($datauser->tipo_sanguineo),
          'fazUsoMed' => $datauser->fazUsoMed,
          'medicamentos' => mb_strtoupper($datauser->medicamentos),
          'alergias' => mb_strtoupper($datauser->alergias),
          'deficiencias' => mb_strtoupper($datauser->deficiencias),
          'restric_alimentos' => mb_strtoupper($datauser->restric_alimentos)     
      ];  

      $this->view('datausers/index', $data);
    }

    public function show(){
      if ($dados = $this->dataModel->getAlunosUsuario($_SESSION[DB_NAME . '_user_id'])){   
        foreach($dados as $dado){
          $data[] = [
            'aluno_id' => $dado->aluno_id,
            'nome_aluno' => $dado->nome_aluno,
            'nascimento' => $dado->nascimento,
            'ultima_atualizacao' => $this->dadosModel->getUltimaAtualizacaoById($dado->aluno_id)
          ];
        }
        $this->view('datausers/show', $data);
      } else {
        $this->view('datausers/show', $data = ['error' => "Ainda não existem alunos cadastrados"]);
      }
    }
   
    public function add(){

      // Check for POST            
      if($_SERVER['REQUEST_METHOD'] == 'POST'){        
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
        
        $data = [              
          'nome_aluno' => mb_strtoupper(trim($_POST['nome_aluno'])),
          'nascimento' => $_POST['nascimento'],
          'sexo' => $_POST['sexo'],
          'telefone_aluno' => $_POST['telefone_aluno'],
          'email_aluno' => trim($_POST['email_aluno']),
          'nome_pai' => mb_strtoupper(trim($_POST['nome_pai'])),
          'telefone_pai' => $_POST['telefone_pai'],
          'nome_mae' => mb_strtoupper(trim($_POST['nome_mae'])),
          'telefone_mae' => $_POST['telefone_mae'],
          'nome_responsavel' => mb_strtoupper(trim($_POST['nome_responsavel'])),
          'telefone_resp' => $_POST['telefone_resp'],
          'naturalidade' => mb_strtoupper(trim($_POST['naturalidade'])),
          'nacionalidade' => mb_strtoupper(trim($_POST['nacionalidade'])),
          'end_rua' => mb_strtoupper($_POST['end_rua']), 
          'end_numero' => $_POST['end_numero'], 
          'end_bairro_id' => $_POST['end_bairro_id'],
          'rg' => trim($_POST['rg']),
          'uf_rg' => $_POST['uf_rg'],
          'orgao_emissor' => mb_strtoupper(trim($_POST['orgao_emissor'])),
          'titulo_eleitor' => trim($_POST['titulo_eleitor']),
          'zona' => trim($_POST['zona']),
          'secao' => trim($_POST['secao']),
          'certidao' => mb_strtoupper(trim($_POST['certidao'])),
          'uf_cert' => $_POST['uf_cert'],
          'cartorio_cert' => mb_strtoupper(trim($_POST['cartorio_cert'])),
          'modelo' => $_POST['modelo'],
          'numero' => trim($_POST['numero']),
          'folha' => trim($_POST['folha']),
          'livro' => trim($_POST['livro']),
          'data_emissao_cert' => $_POST['data_emissao_cert'],
          'municipio_cert' => mb_strtoupper(trim($_POST['municipio_cert'])),
          'cpf' => $_POST['cpf'],
          'tipo_sanguineo' => mb_strtoupper(trim($_POST['tipo_sanguineo'])),
          'fazUsoMed' => trim($_POST['fazUsoMed']),
          'medicamentos' => mb_strtoupper(trim($_POST['medicamentos'])),
          'alergias' => mb_strtoupper(trim($_POST['alergias'])),
          'deficiencias' => mb_strtoupper(trim($_POST['deficiencias'])),
          'restric_alimentos' => mb_strtoupper(trim($_POST['restric_alimentos'])) 
        ];
        
        if(empty($data['nome_aluno'])){
            $data['nome_aluno_err'] = 'Por favor informe o nome do aluno';
        }
        
        if(empty($data['nascimento'])){
            $data['nascimento_err'] = 'Por favor informe a data de nascimento do aluno';
        }
        
        if (!valida($data['nascimento'])){
          $data['nascimento_err'] = 'Data inválida';
        }

        if(!empty($data['telefone_aluno'])){
          if(!validacelular($data['telefone_aluno'])){
            $data['telefone_aluno_err'] = 'Telefone inválido';
          }
        }

        if(!empty($data['email_aluno'])){
          if(!validaemail($data['email_aluno'])){
            $data['email_aluno_err'] = 'E-mail inválido';
          }
        }            

        if(!empty($data['telefone_pai'])){
          if(!validacelular($data['telefone_pai'])){
            $data['telefone_pai_err'] = 'Telefone inválido';
          }
        }

        if(!empty($data['telefone_mae'])){
          if(!validacelular($data['telefone_mae'])){
            $data['telefone_mae_err'] = 'Telefone inválido';
          }
        }

        if(!empty($data['telefone_resp'])){
          if(!validacelular($data['telefone_resp'])){
            $data['telefone_resp_err'] = 'Telefone inválido';
          }
        }
        
        if(empty($data['certidao'])){
            $data['certidao_err'] = 'Por favor informe o número da certidão de nascimento';
        } 
        
        if(empty($data['uf_cert'])){
            $data['uf_cert_err'] = 'Por favor informe a UF da certidão de nascimento';
        } 

        if(empty($data['modelo'])){
          $data['modelo_err'] = 'Por favor informe o modelo da certidão de nascimento';
        } 

        if(!empty($data['cpf'])){
          if(!validaCPF($data['cpf'])){
            $data['cpf_err'] = 'CPF inválido';
          }
        }

        if(!empty($data['data_emissao_cert'])){
          if(!valida($data['data_emissao_cert'])){
            $data['data_emissao_cert_err'] = 'Data inválida';
          }
        }
        
        // Make sure errors are empty
        if(                    
            empty($data['nome_aluno_err']) &&
            empty($data['nascimento_err']) && 
            empty($data['certidao_err']) &&
            empty($data['uf_cert_err']) &&
            empty($data['modelo_err']) 
            ){ 
              
                try {
                  if($this->dataModel->register($data)){                         
                    flash('mensagem', 'Dados registrados com sucesso');                        
                    redirect('datausers/show');
                  }                 
                } catch (Exception $e) {
                  die('Ops! Algo deu errado.');  
                }  

            } else {
              // Load the view with errors
              $this->view('datausers/add', $data);
            } 
    
      } else {
        // Init data
        $data = [              
          'nome_aluno' => '',
          'nascimento' => '',
          'sexo' => '',
          'telefone_aluno' => '',
          'email_aluno' => '',
          'nome_pai' => '',
          'telefone_pai' => '',
          'nome_mae' => '',
          'telefone_mae' => '',
          'nome_responsavel' => '',
          'telefone_resp' => '',
          'naturalidade' => '',
          'nacionalidade' => '',
          'end_rua' => '',
          'end_numero' => '',
          'end_bairro_id' => '',
          'rg' => '',
          'uf_rg' => '',
          'orgao_emissor' => '',
          'titulo_eleitor' => '',
          'zona' => '',
          'secao' => '',
          'certidao' => '',
          'uf_cert' => '',
          'cartorio_cert' => '',
          'modelo' => '',
          'numero' => '',
          'folha' => '',
          'livro' => '',
          'data_emissao_cert' => '',
          'municipio_cert' => '',
          'cpf' => '',
          'tipo_sanguineo' => '',
          'fazUsoMed' => '',
          'medicamentos' => '',
          'alergias' => '',
          'deficiencias' => '',
          'restric_alimentos' => ''
      ];
        // Load view
        $this->view('datausers/add', $data);
      }     
    }


    public function edit($id){  
                 
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
       
        $data = [ 
          'aluno_id' => $id,
          'nome_aluno' => mb_strtoupper(trim($_POST['nome_aluno'])),
          'nascimento' => $_POST['nascimento'],
          'sexo' => $_POST['sexo'],
          'telefone_aluno' => $_POST['telefone_aluno'],
          'email_aluno' => trim($_POST['email_aluno']),
          'nome_pai' => mb_strtoupper(trim($_POST['nome_pai'])),
          'telefone_pai' => $_POST['telefone_pai'],
          'nome_mae' => mb_strtoupper(trim($_POST['nome_mae'])),
          'telefone_mae' => $_POST['telefone_mae'],
          'nome_responsavel' => mb_strtoupper(trim($_POST['nome_responsavel'])),
          'telefone_resp' => $_POST['telefone_resp'],
          'naturalidade' => mb_strtoupper(trim($_POST['naturalidade'])),
          'nacionalidade' => mb_strtoupper(trim($_POST['nacionalidade'])),
          'end_rua' => mb_strtoupper($_POST['end_rua']), 
          'end_numero' => $_POST['end_numero'], 
          'end_bairro_id' => $_POST['end_bairro_id'],
          'rg' => trim($_POST['rg']),
          'uf_rg' => $_POST['uf_rg'],
          'orgao_emissor' => mb_strtoupper(trim($_POST['orgao_emissor'])),
          'titulo_eleitor' => trim($_POST['titulo_eleitor']),
          'zona' => trim($_POST['zona']),
          'secao' => trim($_POST['secao']),
          'certidao' => mb_strtoupper(trim($_POST['certidao'])),
          'uf_cert' => $_POST['uf_cert'],
          'cartorio_cert' => mb_strtoupper(trim($_POST['cartorio_cert'])),
          'modelo' => $_POST['modelo'],
          'numero' => trim($_POST['numero']),
          'folha' => trim($_POST['folha']),
          'livro' => trim($_POST['livro']),
          'data_emissao_cert' => $_POST['data_emissao_cert'],
          'municipio_cert' => mb_strtoupper(trim($_POST['municipio_cert'])),
          'cpf' => $_POST['cpf'],
          'tipo_sanguineo' => mb_strtoupper(trim($_POST['tipo_sanguineo'])),
          'fazUsoMed' => trim($_POST['fazUsoMed']),
          'medicamentos' => mb_strtoupper(trim($_POST['medicamentos'])),
          'alergias' => mb_strtoupper(trim($_POST['alergias'])),
          'deficiencias' => mb_strtoupper(trim($_POST['deficiencias'])),
          'restric_alimentos' => mb_strtoupper(trim($_POST['restric_alimentos'])) 
        ];

        if(empty($data['nome_aluno'])){
            $data['nome_aluno_err'] = 'Por favor informe o nome do aluno';
        } 

       
        if(empty($data['nascimento'])){
            $data['nascimento_err'] = 'Por favor informe a data de nascimento do aluno';
        }
        
        if (!valida($data['nascimento'])){
          $data['nascimento_err'] = 'Data inválida';
        }

        if(!empty($data['telefone_aluno'])){
          if(!validacelular($data['telefone_aluno'])){
            $data['telefone_aluno_err'] = 'Telefone inválido';
          }
        }

        if(!empty($data['email_aluno'])){
          if(!validaemail($data['email_aluno'])){
            $data['email_aluno_err'] = 'E-mail inválido';
          }
        }            

        if(!empty($data['telefone_pai'])){
          if(!validacelular($data['telefone_pai'])){
            $data['telefone_pai_err'] = 'Telefone inválido';
          }
        }

        if(!empty($data['telefone_mae'])){
          if(!validacelular($data['telefone_mae'])){
            $data['telefone_mae_err'] = 'Telefone inválido';
          }
        }

        if(!empty($data['telefone_resp'])){
          if(!validacelular($data['telefone_resp'])){
            $data['telefone_resp_err'] = 'Telefone inválido';
          }
        }
        
        if(empty($data['certidao'])){
            $data['certidao_err'] = 'Por favor informe o número da certidão de nascimento';
        } 
        
        if(empty($data['uf_cert'])){
            $data['uf_cert_err'] = 'Por favor informe a UF da certidão de nascimento';
        } 

        if(empty($data['modelo'])){
          $data['modelo_err'] = 'Por favor informe o modelo da certidão de nascimento';
        } 

        if(!empty($data['cpf'])){
          if(!validaCPF($data['cpf'])){
            $data['cpf_err'] = 'CPF inválido';
          }
        }

        if(!empty($data['data_emissao_cert'])){
          if(!valida($data['data_emissao_cert'])){
            $data['data_emissao_cert_err'] = 'Data inválida';
          }
        }
        
        // Make sure errors are empty
        if(                    
            empty($data['nome_aluno_err']) &&
            empty($data['nascimento_err']) && 
            empty($data['certidao_err']) &&
            empty($data['uf_cert_err']) &&
            empty($data['modelo_err']) 
            ){
              
                try {
                  if($this->dataModel->update($data)){                      
                    flash('mensagem', 'Dados atualizados com sucesso');                        
                  redirect('datausers/show/' . $id);
                  }                 
                } catch (Exception $e) {
                  die('Ops! Algo deu errado.');  
                } 
              
            } else {
              // Load the view with errors
              $this->view('datausers/add', $data);
            }               

    
      } else {       

        $data = $this->dataModel->getAlunoById($id);  
                      
        $data = [ 
          'aluno_id' => $data->aluno_id,
          'nome_aluno' => $data->nome_aluno,
          'nascimento' => $data->nascimento,          
          'sexo' => $data->sexo,
          'telefone_aluno' => $data->telefone_aluno,
          'email_aluno' =>  $data->email_aluno,
          'nome_pai' => $data->nome_pai,
          'telefone_pai' => $data->telefone_pai,
          'nome_mae' => $data->nome_mae,
          'telefone_mae' => $data->telefone_mae,
          'nome_responsavel' => $data->nome_responsavel,
          'telefone_resp' => $data->telefone_resp,
          'naturalidade' => $data->naturalidade,
          'nacionalidade' => $data->nacionalidade,
          'end_rua' => $data->end_rua,
          'end_numero' => $data->end_numero,
          'end_bairro_id' => $data->end_bairro_id,
          'rg' => $data->rg,
          'uf_rg' => $data->uf_rg,
          'orgao_emissor' => $data->orgao_emissor,
          'titulo_eleitor' => $data->titulo_eleitor,
          'zona' => $data->zona,
          'secao' => $data->secao,
          'certidao' => $data->certidao,
          'uf_cert' => $data->uf_cert,
          'cartorio_cert' => $data->cartorio_cert,
          'modelo' => $data->modelo,
          'numero' => $data->numero,
          'folha' => $data->folha,
          'livro' => $data->livro,
          'data_emissao_cert' => $data->data_emissao_cert,
          'municipio_cert' => $data->municipio_cert,
          'cpf' => $data->cpf,
          'tipo_sanguineo' => $data->tipo_sanguineo,
          'fazUsoMed' => $data->fazUsoMed,
          'medicamentos' => $data->medicamentos,
          'alergias' =>  $data->alergias,
          'deficiencias' => $data->deficiencias,
          'restric_alimentos' => $data->restric_alimentos
        ];
        // Load view
        $this->view('datausers/edit', $data);
      } 
    }


    public function delete($id){
        
      $aluno = $this->dataModel->getAlunoById($id);

      if($aluno->user_id != $_SESSION[DB_NAME . '_user_id']){
        die("Você não tem permissão para excluir este aluno");
      }
      
      if($this->dataModel->deleteAluno($id)){                
        flash('mensagem', 'Registro removido com sucesso!');                
      } else {
        flash('mensagem', 'Falha ao tentar remover o registro', 'alert alert-danger');
      }


      if ($dados = $this->dataModel->getAlunosUsuario($_SESSION[DB_NAME . '_user_id'])){

        foreach($dados as $dado){
          $data[] = [
            'aluno_id' => $dado->aluno_id,
            'nome_aluno' => $dado->nome_aluno,
            'nascimento' => $dado->nascimento,
            'ultima_atualizacao' => $this->dadosModel->getUltimaAtualizacaoById($dado->aluno_id)
          ];
        }

        $this->view('datausers/show', $data);
      } else {
        $this->view('datausers/show', $data = ['error' => "Ainda não existem alunos cadastrados"]);
      }       
    }

    

}//class