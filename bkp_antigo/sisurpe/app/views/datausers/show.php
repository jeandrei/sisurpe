<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('mensagem');?>

<div class="row align-items-center mb-3"> 
    <div class="col-md-10">
        <h4>Alunos cadastrados por <?php echo $_SESSION[DB_NAME . '_user_name'];?></h4>
    </div>
    <div class="col-md-2">
        <a href="<?php echo URLROOT; ?>/datausers/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Adicionar
        </a>
    </div>
</div> 

 <!--INFORMATIVO DE OPÇÕES DE ESCOLHA-->
 <div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info" role="alert">
            <p>Os Dados Escolares e Dados de Transporte Escolar devem ser inseridos <strong>anualmente.</strong></p>
            <p>Manteinha os dados <strong>atualizados</strong>, as informações registradas aqui 
            servirão de base para a <strong>distribuição dos uniformes escolares</strong>, bem como ajudarão 
            no <strong>planejamento e melhoria do Trensporte Escolar.</strong></p>
            <p>Você está informando os dados referentes ao ano de <strong><?php echo date("Y"); ?></strong>.
        </div>
    </div>
<!--INFORMATIVO DE OPÇÕES DE ESCOLHA-->
</div>

<?php

// Caso ainda não tenham registros de aluno para o usuário
if(empty($data)){ 
  $data = ['error' => "Ainda não existem alunos cadastrados"]; 
}

if(isset($data['error'])){ 
  die($data['error']);
} 

?>  
               
<?php foreach ($data as $registro): ?>
    <div class="card card-body mb-3">
        
        <!--text-right para alinhar os botões no lado direito-->
        <div class="text-right" style="margin-bottom:2rem;">
            <!--btn-group para agrupar os botões--> 
            <div class="btn-group"> 

                    <a href="<?php echo URLROOT; ?>/datausers/edit/<?php echo $registro['aluno_id']; ?>" class="fa fa-edit btn btn-success btn-lg">Editar</a>

                    <a 
                        href="<?php echo URLROOT; ?>/datausers/delete/<?php echo $registro['aluno_id'];?>" 
                        class="fa fa-remove btn btn-danger btn-lg <?php echo ($this->dadosModel->getDadosAnuaisByid($registro['aluno_id'])) ? 'disabled' : ''; ?>"
                        onclick="if(question('Tem certeza que deseja remover o registro?') == true)
                                {
                                    document.forms[0].submit();
                                }
                                else
                                {										
                                    return false;
                                }"                       
                    >                        
                        Remover
                    </a>    

            </div>
        </div> 
        
        <h4 class="card-title">Nome: <?php echo strtoupper($registro['nome_aluno']); ?></h4>
        
        <div class="bg-light p-2 mb-3">
        Nascimento: <b><?php echo date('d/m/Y', strtotime($registro['nascimento'])); ?></b>
        </div>
        
        <div class="bg-light p-2 mb-3">
        Ultima atualização dos Dados Escolares em: <b><?php echo ($this->dadosModel->getDadosAnuaisByid($registro['aluno_id'])) ? date('d/m/Y', strtotime($registro['ultima_atualizacao']->ultima_atual)) : 'Aluno sem informação de Dados Escolares para o ano de ' . date("Y"); ?></b>
        </div>     

        <div class="bg-light p-2 mb-3">
        Linhas que o aluno utiliza em: 
            <b>
                <?php 
                    if($linhas = $this->transporteModel->getLinhasAlunoById($registro['aluno_id'])){ 
                        echo "|";                                
                        foreach($linhas as $linha){
                            echo $linha->linha . "|";
                        }
                    } else {
                        echo "Aluno sem informação de Dados de Transporte Escolar para o ano de " . date("Y");;
                    }
                ?>
            </b>
        </div>
        
        <div class="row">
            
                <a href="<?php echo URLROOT; ?>/anuals/index/<?php echo $registro['aluno_id']; ?>" class="btn btn-dark btn-block">
                Dados Escolares</a>
        
            
                <a href="<?php echo URLROOT; ?>/transportes/index/<?php echo $registro['aluno_id']; ?>" class="btn btn-secondary btn-block">
                Dados de Transporte Escolar</a>
            
        </div>   
            
    </div>
<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>