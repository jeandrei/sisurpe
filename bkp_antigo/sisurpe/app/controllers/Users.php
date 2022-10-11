<?php 
    class Users extends Controller{

        public function __construct(){
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            $this->userModel = $this->model('User');
        }

        public function register(){
            
            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                //init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ]; 

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Por favor informe seu email';
                } else {
                    if(!validaemail($data['email'])){
                        $data['email_err'] = 'Email inválido';  
                    }else{
                        
                        if($this->userModel->findUserByEmail($data['email'])){
                            $data['email_err'] = 'Email já existente'; 
                        }
                    }                    
                }

                // Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = 'Por favor informe o nome';
                }

                 // Validate Password
                 if(empty($data['password'])){
                    $data['password_err'] = 'Por favor informe a senha';
                } elseif (strlen($data['password']) < 6){
                    $data['password_err'] = 'Senha deve ter no mínimo 6 caracteres';
                }

                // Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Por favor confirme a senha';
                } else {
                    if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Senha e confirmação de senha diferentes';    
                    }
                }

                // Make sure errors are empty
                if(                    
                    empty($data['email_err']) &&
                    empty($data['name_err']) && 
                    empty($data['password_err']) &&
                    empty($data['confirm_password_err']) 
                    ){
                      //Validated
                      
                      // Hash Password criptografa o password
                      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                      // Register User
                      if($this->userModel->register($data)){
                        // Cria a menságem antes de chamar o view va para 
                        // views/users/login a segunda parte da menságem
                        flash('register_success', 'Você está registrado e pode efetuar o login');                        
                        redirect('users/login');
                      } else {
                          die('Ops! Algo deu errado.');
                      }
                      

                      
                    } else {
                      // Load the view with errors
                      $this->view('users/register', $data);
                    }
            
            } else {
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
                // Load view
                $this->view('users/register', $data);
            }
        }

        public function login(){          
            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //init data
                $data = [                    
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),  
                    'email_err' => '',
                    'password_err' => ''
                    
                ];      

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Por favor informe seu email';
                } else {
                    // Check for user/email
                    if($this->userModel->findUserByEmail($data['email'])){
                        // User found
                    } else {
                    $data['email_err'] = 'Usuário não encontrado';
                    }
                }
               

                 // Validate Password
                 if(empty($data['password'])){
                    $data['password_err'] = 'Por favor informe sua senha';
                } 

                
                               
                // Make sure errors are empty
                if(                    
                    empty($data['email_err']) &&                     
                    empty($data['password_err'])                     
                    ){
                      //Validate
                      // 1 Check and set loged in user
                      // 2 models/User login();
                      $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                      
                      if($loggedInUser){
                        // Create Session 
                        // função no final desse arquivo
                        $this->createUserSession($loggedInUser);
                      } else {
                          $data['password_err'] = 'Senha incorreta';

                          $this->view('users/login', $data);
                      }
                    } else {
                      // Load the view with errors
                      $this->view('users/login', $data);
                    }               

            
            } else {
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
                // Load view
                $this->view('users/login', $data);
            }
    }

    public function createUserSession($user){
        // $user->id vem do model na função login() retorna a row com todos os campos
        // da consulta na tabela users
        $_SESSION[DB_NAME . '_user_id'] = $user->id;
        $_SESSION[DB_NAME . '_user_email'] = $user->email;
        $_SESSION[DB_NAME . '_user_name'] = $user->name;
        $_SESSION[DB_NAME . '_user_type'] = $user->type;
        redirect('datausers/show');
    }

    public function logout(){
        unset($_SESSION[DB_NAME . '_user_id']);
        unset($_SESSION[DB_NAME . '_user_email']);
        unset($_SESSION[DB_NAME . '_user_name']);
        session_destroy();
        redirect('pages/login'); 
    }

    public function isLoggedIn(){
        if(isset($_SESSION[DB_NAME . '_user_id'])){
            return true;
        } else {
            return false;
        }
    }


    public function enviasenha(){

        // Check for POST            
        if($_SERVER['REQUEST_METHOD'] == 'POST'){           

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //init data
            $data = [                
                'email' => trim($_POST['email'])               
            ];  

            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Por favor informe seu email';
            } else {
                if(!validaemail($data['email'])){
                    $data['email_err'] = 'Email inválido';  
                }else{
                    
                    if(!$this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email ainda não cadastrado'; 
                    }
                }                    
            }

            // Make sure errors are empty
            if(                    
                empty($data['email_err'])                  
                ){
                  //ENVIA O EMAIL
                  
                  // CRIA UMA NOVA SENHA RANDOMICAMENTE
                  $password = RandomPassword();

                  // Hash Password CRIPTOGRAFA O PASSWORD
                  $data['password'] = password_hash($password, PASSWORD_DEFAULT);

                  try {
                        // ATUALIZA O PASSWORD NO BANCO DE DADOS
                        if($this->userModel->updatepassword($data)){
                            
                            //MANDE O EMAIL COM A SENHE
                            if($this->userModel->sendemail($data['email'], $password)){
                                flash('register_success', 'Email enviado com sucesso!');                     
                                redirect('users/login');
                            } else {
                                flash('mensagem_erro', 'Erro no envio do email! Tente novamente mais tarde.','alert-danger');                     
                                redirect('users/enviasenha');
                            }                   
                        }

                  } catch (Exception $e) {
                    die('Ops! Algo deu errado.');  
                  }  
                  
                } else {
                  // Load the view with errors
                  $this->view('users/enviasenha', $data);
                } 

        } else {
            // Init data
            $data = [               
                'email' => ''                
            ];
            // Load view            
            $this->view('users/enviasenha', $data);
        }       
        
    //enviasenha()
    } 

    public function alterasenha(){
        // Check for POST            
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            //init data
            $data = [                
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'password_err' => '',
                'confirm_password_err' => ''               
            ]; 

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Por favor informe a senha';
            } elseif (strlen($data['password']) < 6){
                $data['password_err'] = 'Senha deve ter no mínimo 6 caracteres';
            }

            // Validate Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Por favor confirme a senha';
            } else {
                if($data['password'] != $data['confirm_password']){
                $data['confirm_password_err'] = 'Senha e confirmação de senha diferentes';    
                }
            }            
            // Make sure errors are empty
            if(  
                empty($data['password_err']) &&
                empty($data['confirm_password_err']) 
                ){
                     // Hash Password criptografa o password
                     $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);                     
                     $data['email'] = $_SESSION[DB_NAME . '_user_email'];                     
                     // Register User
                     if($this->userModel->updatePassword($data)){
                       // Cria a menságem antes de chamar o view va para 
                       // views/users/login a segunda parte da menságem
                       flash('mensagem', 'Senha atualizada com Sucesso');                        
                       redirect('datausers/show');
                     } else {
                         die('Ops! Algo deu errado.');
                     }
                   
                } else {
                    $this->view('users/alterasenha', $data);   
                }
            
        }       
        $this->view('users/alterasenha', $data);
    }


    public function admin(){

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
      
        $paginate = $this->userModel->getUsers($page, $options); 
              
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


}   
?>