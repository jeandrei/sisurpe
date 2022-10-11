<?php require APPROOT . '/views/inc/header.php'; ?>

 <div class="row align-items-center mb-3">
    <div class="col-md-12">
        <h1>Dados Anuais do Aluno</h1>  

        <!--BOTÃO VOLTAR-->
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-2">
                <a href="<?php echo URLROOT; ?>/datausers/show" id="voltar" class="btn btn-default btn-block" style="background-color:#FFFAF0">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                </a>
                
            </div>
        </div>  
                       
           
        <form action="<?php echo URLROOT; ?>/anuals/index/<?php echo $data['aluno_id'];?>" method="post" enctype="multipart/form-data">       
            <fieldset>
                <!--NOME-->
                <div class="form-group ">
                    <label for="nome_aluno">Nome do Aluno:</label>  
                    <input 
                      class="form-control form-control-lg" 
                      type="text" 
                      placeholder="<?php echo $data['nome_aluno']; ?>" readonly>         
                </div>  
                
                <!--NASCIMENTO NACIONALIDADE E NATURALIDADE TELEFONE-->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="nascimento">Nascimento</label>
                        <input 
                          class="form-control"
                          type="date"  
                          name="nascimento"
                          value="<?php echo $data['nascimento']; ?>" readonly>
                    </div>            
                </div>  
            </fieldset>
            
            <hr>
            
            <fieldset>  
                <legend>Tamanho do Uniforme</legend>                                    
                <!--UNIFORME-->  
                <div class="form-row">
                    <div class="form-group col-md-3">
                          <label for="kit_inverno">Kit Inverno</label>
                          <select
                            class="form-control"
                            name="kit_inverno"
                            id="kit_inverno"          
                            placeholder="Tamanho do Kit de Inverno">
                            <option value="NULL">Selecione o Tamanho</option>
                            <?php                            
                              echo(imptamanhounif($data['kit_inverno']));
                            ?>
                          </select>
                          <span id="kit_inverno_err" class="text-danger"><?php echo  $data['kit_inverno_err']; ?></span>                              
                    </div>
                   

                    <div class="form-group col-md-3">
                        <label for="kit_verao">Kit Verão</label>
                        <select
                          class="form-control"
                          name="kit_verao"
                          id="kit_verao"          
                          placeholder="Tamanho do Kit de Verão">
                          <option value="NULL">Selecione o Tamanho</option>
                          <?php
                            echo(imptamanhounif($data['kit_verao']));
                          ?>
                        </select>
                        <span id="kit_verao_err" class="text-danger"><?php echo  $data['kit_verao_err']; ?></span>              
                    </div>


                    <div class="form-group col-md-3">
                        <label for="tam_calcado">Calçado</label>
                        <select
                          class="form-control"
                          name="tam_calcado"
                          id="tam_calcado"          
                          placeholder="Tamanho do Calçado">
                          <option value="NULL">Selecione o Tamanho</option>
                          <?php
                            echo(imptamanhounif($data['tam_calcado']));
                          ?>
                        </select>
                        <span id="tam_calcado_err" class="text-danger"><?php echo  $data['tam_calcado_err']; ?></span>              
                    </div>

                <!--PRIMEIRA LINHA DO UNIFORME--> 
                </div>                
            
            </fieldset>

            <hr>

            <fieldset>
                                    
                <legend>Dados de Matrícula</legend>                                    
                <!--LINHA DADOS DE MATRÍCULA-->  
                <div class="form-row">       
                    <!-- ESCOLAS -->
                    <div class="col-lg-4">
                        <label for="escola_id">
                            Escola
                        </label>                             
                    
                        <select 
                            name="escola_id" 
                            id="escola_id" 
                            class="form-control"                                        
                        >
                                <option value="NULL">Selecione a Escola</option>
                                <?php 
                                $escolas =  $this->anualModel->getEscolas();                  
                                foreach($escolas as $escola) : ?> 
                                    <option value="<?php echo $escola->id; ?>"
                                                <?php 
                                                if(isset($_POST['escola_id'])){
                                                  echo $_POST['escola_id'] == $escola->id ? 'selected':'';
                                                } else {
                                                  echo $data['escola_id'] == $escola->id ? 'selected':'';
                                                }
                                                ?>
                                    >
                                        <?php echo $escola->nome;?>
                                    </option>
                                <?php endforeach; ?>  
                        </select>
                        <span id="escola_id_err" class="text-danger"><?php echo  $data['escola_id_err']; ?></span>
                    </div>

                    <!-- ETAPAS -->
                    <div class="col-lg-4">
                        <label for="etapa_id">
                            Turma
                        </label>   
                    <select 
                            name="etapa_id" 
                            id="etapa_id" 
                            class="form-control"                                        
                        >
                                <option value="NULL">Selecione a Etapa</option>
                                <?php 
                                $etapas =  $this->anualModel->getEtapas();                   
                                foreach($etapas as $etapa) : ?> 
                                    <option value="<?php echo $etapa->id; ?>"
                                                <?php 
                                                if(isset($_POST['etapa_id'])){
                                                  echo $_POST['etapa_id'] == $etapa->id ? 'selected':'';
                                                } else {
                                                  echo $data['etapa_id'] == $etapa->id ? 'selected':'';
                                                }
                                                ?>
                                    >
                                        <?php echo $etapa->descricao;?>
                                    </option>
                                <?php endforeach; ?>  
                        </select>
                        <span id="etapa_id_err" class="text-danger"><?php echo  $data['etapa_id_err']; ?></span>
                    </div>

                    <!-- TURNO -->                              
                    <div class="form-group col-md-3">
                      <label for="turno">Turno</label>
                      <select
                        class="form-control <?php echo (!empty($data['uso_med_err'])) ? 'is-invalid' : ''; ?>"      
                        name="turno"
                        id="turno">
                          <option value="NULL" <?php echo (($data['turno'])=="NULL") ? 'selected' : ''; ?> >Selecione</option>
                          <option value="M" <?php echo (($data['turno'])=="M") ? 'selected' : ''; ?> >Matutino</option>
                          <option value="V" <?php echo (($data['turno'])=="V") ? 'selected' : ''; ?> >Vespertino</option>
                          <option value="N" <?php echo (($data['turno'])=="N") ? 'selected' : ''; ?> >Noturno</option>
                      </select>
                      <span id="turno_err" class="text-danger"><?php echo  $data['turno_err']; ?></span>
                    </div>  

                <!-- DADOS DE MATRÍCULA-->                                 
                </div>                                      
            </fieldset>

        <!--BOTÃO SALVAR-->
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-2">                
                <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            </div>
        </div>  

        </form>
        

    </div><!--col-md-12-->
</div><!--div class="row align-items-center mb-3--> 

<?php require APPROOT . '/views/inc/footer.php'; ?>