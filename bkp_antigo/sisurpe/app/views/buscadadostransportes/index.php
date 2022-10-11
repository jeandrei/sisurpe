<?php require APPROOT . '/views/inc/header.php'; ?>

<script>
  function limpar(){
        document.getElementById('ano').value = "";
        document.getElementById('escola_id').value = "NULL";
        document.getElementById('buscanome').value = "";
        document.getElementById('etapa_id').value = "NULL";
        document.getElementById('turno').value = "NULL";
        document.getElementById('linha_id').value = "NULL"; 
        document.getElementById('buscanome').focus();
    }    
    
    document.getElementById('buscanome').focus();

     //PARA ABRIR EM UMA NOVA ABA CRIO ESSA FUNÇÃO NEWTAB QUE É CHAMADA NO EVENTO ONCLICK DO BOTÃO IMPRIMIR
    function newtab(){
      document.getElementById('filtrar').setAttribute('target', '_blank');
    }

    function notab(){
      document.getElementById('filtrar').setAttribute('target', '');
    }   
</script>

<h1><?php echo $data['title']; ?></h1>
<p><?php echo $data['description']; ?></p>

<?php
  $paginate = $data['paginate'];
  $result = $data['results'];
?>

<form id="filtrar" action="<?php echo URLROOT; ?>/buscadadostransportes/index" method="post" enctype="multipart/form-data">
  <div class="row">
    <!-- COLUNA 1 NOME-->
    <div class="col-lg-4">
            <label for="buscanome">
                Buscar por Nome
            </label>
            <input 
                type="text" 
                name="buscanome" 
                id="buscanome" 
                maxlength="60"
                class="form-control"
                value="<?php if(isset($_POST['buscanome'])){htmlout($_POST['buscanome']);} ?>"
                onkeydown="upperCaseF(this)"   
                ><span class="invalid-feedback">
                    <?php // echo $data['nome_err']; ?>
                </span>
    <!--<div class="col-lg-4">-->
    </div>
    
    <div class="col-lg-2">
            <label for="ano">
                Buscar por ANO
            </label>
            <input 
                type="text" 
                name="ano" 
                id="ano" 
                maxlength="60"
                class="form-control"
                value="<?php if(isset($_POST['ano'])){htmlout($_POST['ano']);} ?>"               
                ><span class="invalid-feedback">
                    <?php // echo $data['nome_err']; ?>
                </span>
    <!--<div class="col-lg-4">-->
    </div>

    <!-- COLUNA ESCOLA -->
    <div class="col-lg-4">
        <label for="linha_id">
            Busca por Linha
        </label>  
        <select 
            name="linha_id" 
            id="linha_id" 
            class="form-control"                                        
        >
                <option value="NULL">Todos</option>
                <?php                     
                $linhas = $this->anualModel->getLinhas();                                     
                foreach($linhas as $linha) : ?> 
                    <option value="<?php echo $linha->id; ?>"
                                <?php if(isset($_POST['linha_id'])){
                                echo $_POST['linha_id'] == $linha->id ? 'selected':'';
                                }
                                ?>
                    >
                        <?php echo $linha->linha;?>
                    </option>
                <?php endforeach; ?>  
        </select>
    <!--div class="col-lg-4-->
    </div>   

  <!--div class="row"-->
  </div>

  <hr>

    <div class="row"> 
        <!-- COLUNA ESCOLA -->
        <div class="col-lg-4">
                <label for="escola_id">
                    Escola
                </label>  
                <select 
                    name="escola_id" 
                    id="escola_id" 
                    class="form-control"                                        
                >
                        <option value="NULL">Todos</option>
                        <?php                     
                        $escolas = $this->anualModel->getEscolas();                                     
                        foreach($escolas as $escola) : ?> 
                            <option value="<?php echo $escola->id; ?>"
                                        <?php if(isset($_POST['escola_id'])){
                                        echo $_POST['escola_id'] == $escola->id ? 'selected':'';
                                        }
                                        ?>
                            >
                                <?php echo $escola->nome;?>
                            </option>
                        <?php endforeach; ?>  
                </select>
        <!--div class="col-lg-3-->
        </div>

        <!-- COLUNA ETAPA -->
        <div class="col-lg-4">
                <label for="etapa_id">
                    Etapa
                </label>  
                <select 
                    name="etapa_id" 
                    id="etapa_id" 
                    class="form-control"                                        
                >
                        <option value="NULL">Todos</option>
                        <?php                     
                        $etapas = $this->anualModel->getEtapas();                                     
                        foreach($etapas as $etapa) : ?> 
                            <option value="<?php echo $etapa->id; ?>"
                                        <?php if(isset($_POST['etapa_id'])){
                                        echo $_POST['etapa_id'] == $etapa->id ? 'selected':'';
                                        }
                                        ?>
                            >
                                <?php echo $etapa->descricao;?>
                            </option>
                        <?php endforeach; ?>  
                </select>
        <!--div class="col-lg-3-->
        </div>

        <!-- TURNO -->                              
        <div class="form-group col-md-3">
            <label for="turno">Turno</label>
            <select
                class="form-control"      
                name="turno"
                id="turno">
                <option value="NULL" <?php echo (($_POST['turno'])=="NULL") ? 'selected' : ''; ?> >Selecione</option>
                <option value="M" <?php echo (($_POST['turno'])=="M") ? 'selected' : ''; ?> >Matutino</option>
                <option value="V" <?php echo (($_POST['turno'])=="V") ? 'selected' : ''; ?> >Vespertino</option>
                <option value="N" <?php echo (($_POST['turno'])=="N") ? 'selected' : ''; ?> >Noturno</option>
            </select>         
        </div>

    <!--<div class="row"> -->  
    </div>

<hr>

<div class="row">

    <!-- LINHA PARA O BOTÃO ATUALIZAR -->
    <div class="row" style="margin-top:30px;">
          <div class="col" style="padding-left:0;">
              <div class="form-group mx-sm-3 mb-2">
                <input type="submit" name="botao" class="btn btn-primary mb-2" value="Atualizar" onClick="notab()">
                <input type="submit" name="botao" class="btn btn-primary mb-2" value="Imprimir" onClick="newtab()"> 
                <input type="submit" name="botao" class="btn btn-primary mb-2" value="Imprimir Totais" onClick="newtab()">                
                <input type="button" class="btn btn-primary mb-2" value="Limpar" onClick="limpar()"> 
              </div>                                                
          </div>                  
    <!-- FIM LINHA BOTÃO ATUALIZAR -->
    </div> 

<!--<div class="row">-->
</div>

</form>

<br>

<!-- MONTAR A TABELA -->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nome</th>      
      <th scope="col">Nascimento</th>           
      <th scope="col">Linha</th> 
      <th scope="col">Escola</th>
      <th scope="col">Etapa</th>
      <th scope="col">Turno</th>      
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $row) : ?> 
    <tr>  
      <td><?php echo $row['nome_aluno']; ?></td>
      <td><?php echo date('d-m-Y', strtotime($row['nascimento_aluno'])); ?></td>
      <td><?php echo $row['linha']; ?></td> 
      <td><?php echo $row['escola']; ?></td>
      <td><?php echo $row['etapa']; ?></td>
      <td><?php echo $row['turno']; ?></td>      
    </tr>
    <?php endforeach; ?>    
  </tbody>
</table>
<?php  
    
  


    /*
     * Echo out the UL with the page links
     */
    echo '<p>'.$paginate->links_html.'</p>';

    /*
     * Echo out the total number of results
     */
    echo '<p style="clear: left; padding-top: 10px;">Total de Registros: '.$paginate->total_results.'</p>';

    /*
     * Echo out the total number of pages
     */
    echo '<p>Total de Paginas: '.$paginate->total_pages.'</p>';

    echo '<p style="clear: left; padding-top: 10px; padding-bottom: 10px;">-----------------------------------</p>';

   












?>














<?php require APPROOT . '/views/inc/footer.php'; ?>