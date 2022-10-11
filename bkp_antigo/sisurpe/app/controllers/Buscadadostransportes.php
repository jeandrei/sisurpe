<?php
 class Buscadadostransportes extends Controller {

    public function __construct(){                
        //isLoggedIn do arquivo session_helper.php
        if(!isLoggedIn()){
          redirect('users/login');
        }       
        $this->buscadadostransportesModel = $this->model('Buscadadostransporte');
        $this->anualModel = $this->model('Anual');
        $this->dataModel = $this->model('Datauser');
    }
   
    public function index(){ 
        
        $limit = 10;
        $data = [
            'title' => 'Busca por daos de Transporte',
            'description' => 'Busca por registros anuais do Transporte Escolar'          
        ];

        // INÍCIO PARTE PAGINAÇÃO SÓ COPIAR ESSA PARTE MUDAR A URL E COLOCAR OS PARAMETROS EM named_params
        // O STATUS EU NÃO PASSO PARA O A CONSULTA É APENAS PARA MANTER AS INFORMAÇÕES APÓS CLICAR NO LINK DA PAGINAÇÃO
        // CASO CONTRÁRIO TODA VEZ QUE CLICASSE NO LINK DA PAGINAÇÃO ELE VOLTA PARA O VALOR PADRÃO DO CAMPO DE BUSCA
        if(isset($_GET['page']))
        {
            //ENTRA AQUI SE FOR CLICADO PELO LINK DA PAGINAÇÃO
            $page = $_GET['page']; 
            
            
            $nome =$_GET['nome'];
            $_POST['buscanome'] =  $nome;

            $linha_id =$_GET['linha_id'];
            $_POST['linha_id'] =  $linha_id;


            $escola_id =$_GET['escola_id'];
            $_POST['escola_id'] =  $escola_id;

            $etapa_id =$_GET['etapa_id'];
            $_POST['etapa_id'] =  $etapa_id;

            $turno =$_GET['turno'];
            $_POST['turno'] =  $turno;

            $ano =$_GET['ano'];
            $_POST['ano'] =  $ano;
            
        }
        else
        {           
            // SE ENTROU AQUI É QUE FOI CARREGADO A PÁGINA PELA PRIMEIRA VEZ OU FOI CLICADO EM ATUALIZAR
            // LOGO SE TENHO ALGUM VALOR NO POST DE BUSCA PASSO PARA A VARIÁVEL STATUS E POR FIM SE AINDA ASSIM 
            //A VARIÁVEL ESTIVER VAZIA PASSO O VALOR PADRÃO 'Todos'
            $nome = $_POST['buscanome'];
            $linha_id = $_POST['linha_id'];
            $escola_id = $_POST['escola_id'];
            $etapa_id = $_POST['etapa_id'];
            $turno = $_POST['turno'];
            $ano = $_POST['ano'];

            $page = 1;
        }             
                
        $options = array(
            'results_per_page' => 10,
            'url' => URLROOT . '/buscadadostransportes/index.php?page=*VAR*&nome=' . $nome . '&ano=' . $ano . '&linha_id=' . $linha_id . '&escola_id=' . $escola_id . '&etapa_id=' . $etapa_id . '&turno=' . $turno,
            'named_params' => array(
                                        ':nome' => $nome,
                                        ':linha_id' => $linha_id,                                    
                                        ':escola_id' => $escola_id,
                                        ':etapa_id' => $etapa_id,
                                        ':turno' => $turno,
                                        ':ano' => $ano
                                    )     
        );

        
        $paginate = $this->buscadadostransportesModel->getDados($page, $options);

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

        //SE O BOTÃO CLICADO FOR O IMPRIMIR EU CHAMO A FUNÇÃO getDados($page, $options,1) ONDE 1 É QUE É PARA IMPRIMIR E 0 É PARA LISTAR NA PAGINAÇÃO
        if($_POST['botao'] == "Imprimir"){  
            $data = $this->buscadadostransportesModel->getDados($page, $options,1);  
            // E AQUI CHAMO O RELATÓRIO          
            $this->view('relatorios/reTransporte' ,$data);
        } else if($_POST['botao'] == "Imprimir Totais") {
           // E AQUI CHAMO O RELATÓRIO TOTAIS CHAMO O RELATÓRIO DE TOTAIS
            $data = $this->buscadadostransportesModel->getTotais();            
            $this->view('relatorios/reTransporteTotais' ,$data);
        } else {
            // SE NÃO FOR IMPRIMIR CHAMO O INDEX COM OS DADOS NOVAMENTE
            $this->view('buscadadostransportes/index' ,$data);   
        }        
    }

    public function ver($id){ 
        $data = $this->dataModel->getAlunoById($id);        
        $data = [ 
        'aluno_id' => $data->aluno_id,
        'nome_aluno' => $data->nome_aluno,
        'nascimento' => date('Y-d-m', strtotime($data->nascimento)),          
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
        'data_emissao_cert' =>  date('Y-d-m', strtotime($data->data_emissao_cert)),
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
        $this->view('buscaalunos/ver', $data);
    }  

}//class