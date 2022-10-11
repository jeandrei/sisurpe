<?php require APPROOT . '/views/inc/header.php';?>

 <div class="row align-items-center mb-3">
    <div class="col-md-12">
        <h1>Ver Aluno</h1>

        <!--BOTÃO VOLTAR-->
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-2">
                <a href="<?php echo URLROOT; ?>/buscaalunos/index" id="voltar" class="btn btn-default btn-block" style="background-color:#FFFAF0">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                </a>
                
            </div>
        </div>            
           
        <form action="<?php echo URLROOT; ?>/datausers/edit/<?php echo $data['aluno_id'];?>" method="post" enctype="multipart/form-data">        

        <!--NOME-->
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="nome_aluno"><sup class="obrigatorio">*</sup> Nome do Aluno:</label>  
                <input 
                    class="form-control <?php echo (!empty($data['nome_aluno_err'])) ? 'is-invalid' : ''; ?>"
                    type="text" 
                    name="nome_aluno"
                    id="nome_aluno"
                    value="<?php echo $data['nome_aluno']; ?>"                       
                    placeholder="Nome do aluno" readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['nome_aluno_err']; ?>
                </div>                   
            </div>
        </div>        
            
        <legend>Dados pessoais do Aluno</legend>
        <fieldset>
        <!--NASCIMENTO NACIONALIDADE E NATURALIDADE TELEFONE-->
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="nascimento"><sup class="obrigatorio">*</sup>Nascimento</label>
                <input 
                  class="form-control <?php echo (!empty($data['nascimento_err'])) ? 'is-invalid' : ''; ?>"
                  type="date"  
                  id="nascimento"
                  name="nascimento"
                  value="<?php echo $data['nascimento']; ?>"
                  readonly
                  > 
                <div class="invalid-feedback">
                    <?php echo $data['nascimento_err']; ?>
                </div>  
            </div>
            <div class="form-group col-md-4">
                <label for="nacionalidade">Nacionalidade</label>
                <input 
                  class="form-control <?php echo (!empty($data['nacionalidade_err'])) ? 'is-invalid' : ''; ?>"
                  type="text" 
                  name="nacionalidade" 
                  id="nacionalidade"
                  value="<?php echo $data['nacionalidade']; ?>"          
                  placeholder="Nacionalidade do aluno"
                  readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['nacionalidade_err']; ?>
                </div>         
            </div>
            <div class="form-group col-md-4">
                <label for="naturalidade">Naturalidade</label>
                <input 
                  class="form-control <?php echo (!empty($data['naturalidade_err'])) ? 'is-invalid' : ''; ?>"
                  type="text"
                  name="naturalidade" 
                  id="naturalidade" 
                  value="<?php echo $data['naturalidade']; ?>"                 
                  placeholder="Naturalidade do aluno"
                  readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['naturalidade_err']; ?>
                </div>
            </div>    
        </div>

        <!--ENDEREÇO-->
        <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="end_rua"><sup class="obrigatorio"></sup>Rua</label>
                    <input 
                      class="form-control <?php echo (!empty($data['end_rua_err'])) ? 'is-invalid' : ''; ?>"
                      type="text"  
                      id="end_rua"
                      name="end_rua"
                      value="<?php echo $data['end_rua']; ?>"
                      readonly
                    > 
                    <div class="invalid-feedback">
                        <?php echo $data['end_rua_err']; ?>
                    </div>  
                </div>
                <div class="form-group col-md-2">
                    <label for="end_numero">Número</label>
                    <input 
                      class="form-control <?php echo (!empty($data['end_numero_err'])) ? 'is-invalid' : ''; ?>"
                      type="number" 
                      name="end_numero" 
                      id="end_numero"
                      value="<?php echo $data['end_numero']; ?>"          
                      placeholder="Número"
                      readonly
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['end_numero_err']; ?>
                    </div>         
                </div>  

                <div class="form-group col-md-4">
                <label for="end_bairro">Bairro</label>
                <input 
                  class="form-control"
                  type="text" 
                  name="end_bairro" 
                  id="end_bairro"
                  value="<?php echo $data['end_bairro']->bairro; ?>"  
                  readonly
                >                        
            </div>                        
                






            <!--row-->
            </div>

          <!--TELEFONE EMAIL E SEXO-->
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="telefone_aluno">Telefone</label>
                <input 
                  class="form-control telefone <?php echo (!empty($data['telefone_aluno_err'])) ? 'is-invalid' : ''; ?>"
                  type="tel" 
                  name="telefone_aluno" 
                  id="telefone_aluno"          
                  maxlength="15"  
                  value="<?php echo $data['telefone_aluno']; ?>"         
                  placeholder="(99) 99999-9999"
                  readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['telefone_aluno_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="email_aluno">Email</label>
                <input 
                  class="form-control <?php echo (!empty($data['email_aluno_err'])) ? 'is-invalid' : ''; ?>"
                  type="text"            
                  name="email_aluno" 
                  id="email_aluno"
                  value="<?php echo $data['email_aluno']; ?>"  
                  placeholder="Email do aluno"
                  readonly
                  >        
                  <div class="invalid-feedback">
                    <?php echo $data['email_aluno_err']; ?>
                  </div>
            </div>
                <div class="form-group col-md-4">  <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="sexom" value="M" <?php echo (($data['sexo'])=="M") ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="sexom">
                          Masculino
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="sexof" value="F" <?php echo (($data['sexo'])=="F") ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="sexof">
                          Feminino
                        </label>
                      </div>        
                    </div>
                </div>
        </div>
        </fieldset>


        <legend>Dados de contato</legend>
        <fieldset>
        <!--NOME PAI E TELEFONE-->  
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="nome_pai">Nome do pai</label>
                <input 
                  class="form-control <?php echo (!empty($data['nome_pai_err'])) ? 'is-invalid' : ''; ?>"
                  type="text"           
                  name="nome_pai" 
                  id="nome_pai" 
                  value="<?php echo $data['nome_pai']; ?>" 
                  placeholder="Nome do pai"
                  readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['nome_pai_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="telefone_pai">Telefone do pai</label>
                <input 
                  class="form-control telefone <?php echo (!empty($data['telefone_pai_err'])) ? 'is-invalid' : ''; ?>"
                  type="tel" 
                  name="telefone_pai" 
                  id="telefone_pai"          
                  maxlength="15"           
                  value="<?php echo $data['telefone_pai']; ?>" 
                  placeholder="(99) 99999-9999"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['telefone_pai_err']; ?>
                </div>
            </div>
        </div>


        <!--NOME MÃE E TELEFONE-->  
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="nome_mae">Nome da mãe</label>
                <input
                  class="form-control <?php echo (!empty($data['nome_mae_err'])) ? 'is-invalid' : ''; ?>" 
                  type="text"           
                  name="nome_mae" 
                  id="nome_mae" 
                  value="<?php echo $data['nome_mae']; ?>" 
                  placeholder="Nome da mãe"
                  readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['nome_mae_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="telefone_mae">Telefone da mãe</label>
                <input 
                  class="form-control telefone <?php echo (!empty($data['telefone_mae_err'])) ? 'is-invalid' : ''; ?>"
                  type="tel" 
                  name="telefone_mae" 
                  id="telefone_mae"          
                  maxlength="15" 
                  value="<?php echo $data['telefone_mae']; ?>" 
                  placeholder="(99) 99999-9999"
                  readonly
                  >  
                  <div class="invalid-feedback">
                    <?php echo $data['telefone_mae_err']; ?>
                  </div>
            </div>
        </div>


        <!--NOME RESPONSAVEL E TELEFONE-->  
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="nome_responsavel">Nome do responsavel</label>
                <input 
                  class="form-control <?php echo (!empty($data['nome_responsavel_err'])) ? 'is-invalid' : ''; ?>" 
                  type="text"           
                  name="nome_responsavel" 
                  id="nome_responsavel" 
                  value="<?php echo $data['nome_responsavel']; ?>" 
                  placeholder="Nome do responsavel"
                  readonly
                  >
                  <div class="invalid-feedback">
                    <?php echo $data['nome_responsavel_err']; ?>
                  </div>
            </div>
            <div class="form-group col-md-2">
                <label for="telefone_responsavel">Telefone do reponsavel</label>
                <input 
                  class="telefone form-control <?php echo (!empty($data['telefone_resp_err'])) ? 'is-invalid' : ''; ?>"
                  type="tel" 
                  name="telefone_resp" 
                  id="telefone_resp"           
                  maxlength="15"           
                  value="<?php echo $data['telefone_resp']; ?>" 
                  placeholder="(99) 99999-9999"
                  readonly
                  >    
                  <div class="invalid-feedback">
                    <?php echo $data['telefone_resp_err']; ?>
                  </div>
            </div>
        </div>
        </fieldset>

        <legend>Documentos</legend>
        <fieldset>
        <!--RG E TITULO-->  
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="rg">RG</label>
                <input 
                  class="form-control <?php echo (!empty($data['rg_err'])) ? 'is-invalid' : ''; ?>"
                  type="text"           
                  name="rg" 
                  id="rg" 
                  value="<?php echo $data['rg']; ?>" 
                  placeholder="RG do aluno"
                  readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['rg_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-1">
                <label for="ufrg">UF</label>
                <select
                  class="form-control <?php echo (!empty($data['uf_rg_err'])) ? 'is-invalid' : ''; ?>"
                  name="uf_rg"
                  id="uf_rg"          
                  placeholder="UF RG"
                  readonly
                  >
                  <option value="">UF</option>
                  <?php
                    echo(imprimeuf($data['uf_rg']));
                  ?>
                </select> 
                <div class="invalid-feedback">
                    <?php echo $data['uf_rg_err']; ?>
                </div>             
            </div>
            <div class="form-group col-md-2">
                <label for="ufrg">Órgão Emissor</label>
                <input
                  class="form-control <?php echo (!empty($data['orgao_emissor_err'])) ? 'is-invalid' : ''; ?>"
                  type="text"            
                  name="orgao_emissor" 
                  id="orgao_emissor"
                  value="<?php echo $data['orgao_emissor']; ?>" 
                  placeholder="Órgão emissor do RG"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['orgao_emissor_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="ufrg">Título de eleitor</label>
                <input 
                  class="form-control <?php echo (!empty($data['titulo_eleitor_err'])) ? 'is-invalid' : ''; ?>"
                  type="text"            
                  name="titulo_eleitor" 
                  id="titulo_eleitor" 
                  value="<?php echo $data['titulo_eleitor']; ?>" 
                  placeholder="Título de eleitor"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['titulo_eleitor_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="ufrg">Zona</label>
                <input 
                  class="form-control <?php echo (!empty($data['zona_err'])) ? 'is-invalid' : ''; ?>"
                  type="number"           
                  name="zona" 
                  id="zona" 
                  value="<?php echo $data['zona']; ?>" 
                  placeholder="Zona eleitoral"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['zona_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="ufrg">Seção</label>
                <input 
                  class="form-control <?php echo (!empty($data['secao_err'])) ? 'is-invalid' : ''; ?>"
                  type="text"            
                  name="secao" 
                  id="secao" 
                  value="<?php echo $data['secao']; ?>" 
                  placeholder="Seção eleitoral"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['secao_err']; ?>
                </div>
            </div>
        </div>

        <!--DADOS DA CERTIDÃO-->  
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="rg"><sup class="obrigatorio">*</sup>Certidão de nascimento</label>
                <input 
                  class="form-control <?php echo (!empty($data['certidao_err'])) ? 'is-invalid' : ''; ?>"
                  type="text"           
                  name="certidao" 
                  id="certidao" 
                  value="<?php echo $data['certidao']; ?>" 
                  placeholder="Número da certidão"
                  readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['certidao_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-1">
              <label for="uf_cert"><sup class="obrigatorio">*</sup>UF</label>
              <select
                class="form-control <?php echo (!empty($data['uf_cert_err'])) ? 'is-invalid' : ''; ?>"        
                name="uf_cert"
                id="uf_cert"
                readonly
                >
                <option value="">Selecione</option>
                  <?php
                    echo(imprimeuf($data['uf_cert']));
                  ?>
                </select>
                <div class="invalid-feedback">
                    <?php echo $data['uf_cert_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-2">
              <label for="modelo"><sup class="obrigatorio">*</sup>Modelo</label>
              <select
                class="form-control <?php echo (!empty($data['modelo_err'])) ? 'is-invalid' : ''; ?>"        
                name="modelo"
                id="modelo"
                readonly>
                  <option value="">Selecione</option>
                  <option <?php echo (($data['modelo'] == 'Novo')) ? 'selected' : ''; ?>>Novo</option>
                  <option <?php echo (($data['modelo'] == 'Antigo')) ? 'selected' : ''; ?>>Antigo</option>
              </select>
                <div class="invalid-feedback">
                    <?php echo $data['modelo_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-1">
                <label for="ufrg">Folha</label>
                <input 
                  class="form-control <?php echo (!empty($data['folha_err'])) ? 'is-invalid' : ''; ?>"
                  type="text" 
                  name="folha" 
                  id="folha"
                  value="<?php echo $data['folha']; ?>"            
                  placeholder="Folha"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['folha_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="ufrg">Livro</label>
                <input 
                  class="form-control <?php echo (!empty($data['livro_err'])) ? 'is-invalid' : ''; ?>"
                  type="text" 
                  name="livro" 
                  id="livro"  
                  value="<?php echo $data['livro']; ?>"          
                  placeholder="Livro"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['livro_err']; ?>
                </div>
            </div>        
        </div>

        <!--CONTINUAÇÃO CERTIDÃO-->  
        <div class="form-row"> 
        <div class="form-group col-md-2">
                <label for="ufrg">Município da certidão</label>
                <input 
                  class="form-control <?php echo (!empty($data['municipio_cert_err'])) ? 'is-invalid' : ''; ?>"
                  type="text" 
                  name="municipio_cert" 
                  id="municipio_cert"   
                  value="<?php echo $data['municipio_cert']; ?>"        
                  placeholder="Município certidão"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['municipio_cert_err']; ?>
                </div>
            </div>
        <div class="form-group col-md-2">
                <label for="ufrg">Cartório Certidão</label>
                <input 
                  class="form-control <?php echo (!empty($data['cartorio_cert_err'])) ? 'is-invalid' : ''; ?>"
                  type="text" 
                  name="cartorio_cert" 
                  id="cartorio_cert" 
                  value="<?php echo $data['cartorio_cert']; ?>"            
                  placeholder="Cartório certidão"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['cartorio_cert_err']; ?>
                </div>
            </div>   
            <div class="form-group col-md-2">
                <label for="ufrg">Data emissão</label>
                <input 
                  class="form-control <?php echo (!empty($data['data_emissao_cert_err'])) ? 'is-invalid' : ''; ?>"
                  type="date" 
                  name="data_emissao_cert" 
                  id="data_emissao_cert" 
                  value="<?php echo $data['data_emissao_cert']; ?>"           
                  placeholder="Data emissão"  
                  readonly        
                  >   
                  <div class="invalid-feedback">
                    <?php echo $data['data_emissao_cert_err']; ?>
                  </div> 
            </div>
            <div class="form-group col-md-2">
                <label for="cpf">CPF</label>
                <input 
                  class="form-control cpfmask <?php echo (!empty($data['cpf_err'])) ? 'is-invalid' : ''; ?>" 
                  type="text" 
                  name="cpf" 
                  id="cpf"  
                  value="<?php echo $data['cpf']; ?>"          
                  placeholder="CPF do aluno"
                  readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['cpf_err']; ?>
                </div>
            </div>
            
        </div>
        </fieldset>


        <legend>Dados adicionais</legend>
        <fieldset>
        <!--TIPO SANGUINEO USO DE MEDICAÇÃO MEDICAMENTOS ALERGIA DEFICIENCIAS RESTRIÇÃO ALIMENTOS-->  
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="tipo_sanguineo">Tipo sanguíneo</label>
                <input 
                  class="form-control <?php echo (!empty($data['tipo_sanguineo_err'])) ? 'is-invalid' : ''; ?>"
                  type="text"           
                  name="tipo_sanguineo" 
                  id="tipo_sanguineo" 
                  value="<?php echo $data['tipo_sanguineo']; ?>" 
                  placeholder="Tipo sanguíneo"
                  readonly
                >
                <div class="invalid-feedback">
                    <?php echo $data['tipo_sanguineo_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-3">
              <label for="fazUsoMed">Faz uso de medicamento</label>
              <select
                class="form-control <?php echo (!empty($data['uso_med_err'])) ? 'is-invalid' : ''; ?>"      
                name="fazUsoMed"
                id="fazUsoMed"
                readonly
                >
                  <option value="NI" <?php echo (($data['fazUsoMed'])=="NI") ? 'selected' : ''; ?> >Selecione</option>
                  <option value="Sim" <?php echo (($data['fazUsoMed'])=="Sim") ? 'selected' : ''; ?> >Sim</option>
                  <option value="Não" <?php echo (($data['fazUsoMed'])=="Não") ? 'selected' : ''; ?> >Não</option>
              </select>
              <div class="invalid-feedback">
                    <?php echo $data['uso_med_err']; ?>
              </div>
            </div>
            <div class="form-group col-md-12">
                <label for="medicamentos">Medicamentos</label>
                <input 
                  class="form-control <?php echo (!empty($data['medicamentos_err'])) ? 'is-invalid' : ''; ?>"
                  type="text" 
                  name="medicamentos" 
                  id="medicamentos"           
                  maxlength="255"
                  value="<?php echo $data['medicamentos']; ?>"            
                  placeholder="Medicamentos"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['medicamentos_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="alergias">Alergias</label>
                <input 
                  class="form-control <?php echo (!empty($data['alergias_err'])) ? 'is-invalid' : ''; ?>" 
                  type="text" 
                  name="alergias" 
                  id="alergias"           
                  maxlength="255" 
                  value="<?php echo $data['alergias']; ?>"           
                  placeholder="Alergias"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['alergias_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="deficiencias">Deficiências</label>
                <input 
                  class="form-control <?php echo (!empty($data['deficiencias_err'])) ? 'is-invalid' : ''; ?>" 
                  type="text" 
                  name="deficiencias" 
                  id="deficiencias"           
                  maxlength="255"
                  value="<?php echo $data['deficiencias']; ?>"            
                  placeholder="Deficiências"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['deficiencias_err']; ?>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="restricoes_alimentos">Restrições a alimentos</label>
                <input 
                  class="form-control <?php echo (!empty($data['restric_alimentos_err'])) ? 'is-invalid' : ''; ?>" 
                  type="text" 
                  name="restric_alimentos" 
                  id="restric_alimentos"           
                  maxlength="255"
                  value="<?php echo $data['restric_alimentos']; ?>"         
                  placeholder="Restrições a alimentos"
                  readonly
                >    
                <div class="invalid-feedback">
                    <?php echo $data['restric_alimentos_err']; ?>
                </div>
            </div>
        </div>
        </fieldset>
        </form>

    </div><!--col-md-12-->
</div><!--div class="row align-items-center mb-3-->    
<?php require APPROOT . '/views/inc/footer.php'; ?>

