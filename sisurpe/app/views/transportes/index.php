
<?php require APPROOT . '/views/inc/header.php'; ?>


<?php flash('mensagem');?>


 <div class="row align-items-center mb-3">
    <div class="col-md-12">
        <h1>Dados de Transporte Escolar</h1>

        <!--BOTÃO VOLTAR-->
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-2">
                <a href="<?php echo URLROOT; ?>/datausers/show" id="voltar" class="btn btn-default btn-block" style="background-color:#FFFAF0">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                </a>
                
            </div>
        </div>    
              
           
        <form action="<?php echo URLROOT; ?>/transportes/gravar/<?php echo $data['aluno_id'];?>" method="post" enctype="multipart/form-data">       
           
            <!-- LINHA -->
            <div class="row" style="margin-bottom:20px;"> 
                
                <div class="col-lg-4">
                    <label for="linha">
                        Selecione a Linha
                    </label>
                        <select 
                            name="linha" 
                            id="linha" 
                            class="form-control"                                        
                        >
                                <option value="NULL">Selecione a Linha</option>
                                <?php 
                                $linhas =  $this->transporteModel->getLinhas();                  
                                foreach($linhas as $linha) : ?> 
                                    <option value="<?php echo $linha->id; ?>"
                                                <?php 
                                                if(isset($_POST['linha'])){
                                                echo $_POST['linha'] == $linha->id ? 'selected':'';
                                                } else {
                                                echo $data['linha'] == $linha->id ? 'selected':'';
                                                }
                                                ?>
                                    >
                                        <?php echo $linha->linha;?>
                                    </option>
                                <?php endforeach; ?>  
                        </select>
                        <span id="fila_err" class="text-danger"><?php echo $data['linha_err']; ?></span> 
                </div>

                <div class="col-lg-4" style="margin-top:30px;">
                    <div class="form-group mx-sm-3 mb-2">
                        <!-- BOTÃO GRAVAR o id gravarestado tem que ser o mesmo lá em cima no jquery -->                            
                        <input type="submit" class="btn btn-primary mb-2" value="Adicionar Linha">   
                    </div>                                                
                </div>
                
            <!--LINHA -->
            </div> 
            
        </form>
                                                 
        <?php $linhas = $this->transporteModel->getLinhasAlunoById($data['aluno_id']);
        
        if(empty($linhas)){die("Sem Linhas para este aluno! Selecione a linha e clique em Adicionar Linha");}
        
        ?>

        <?php foreach ($linhas as $registro): ?>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body mb-2">
                        
                        <!--text-right para alinhar os botões no lado direito-->
                        <div class="text-right" style="margin-bottom:1rem;">
                            <a 
                                href="<?php echo URLROOT; ?>/transportes/delete/<?php echo $registro->id;?>" 
                                class="fa fa-remove btn btn-danger btn-lg"
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
                        
                        <h4 class="card-title"><?php echo "Linha: " . $registro->linha; ?></h4>
                        
                        <div class="bg-light p-2 mb-3">
                        <b>ROTA: <?php echo (!empty($registro->rota)) ? $registro->rota : 'Linha sem informações de rota'; ?></b>
                        </div> 
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div><!--col-md-12-->
</div><!--div class="row align-items-center mb-3-->    
<?php require APPROOT . '/views/inc/footer.php'; ?>

