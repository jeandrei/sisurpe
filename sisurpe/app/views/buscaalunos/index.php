<?php require APPROOT . '/views/inc/header.php'; ?>

<script>  
  function limpar(){
          document.getElementById('nome_aluno').value = "";   
          document.getElementById('nome_aluno').focus(); 
      }  
    document.getElementById('nome_aluno').focus(); 
</script>

<h1><?php echo $data['title']; ?></h1>
<p><?php echo $data['description']; ?></p>

<?php
  $paginate = $data['paginate'];
  $result = $data['results'];
?>

<form id="filtrar" action="<?php echo URLROOT; ?>/buscaalunos/index" method="GET" enctype="multipart/form-data">
  <div class="row">
    <!-- COLUNA 1 NOME-->
    <div class="col-lg-4">
            <label for="nome_aluno">
                Buscar por Nome
            </label>
            <input 
                type="text" 
                name="nome_aluno" 
                id="nome_aluno" 
                maxlength="60"
                class="form-control"
                value="<?php if(isset($_GET['nome_aluno'])){htmlout($_GET['nome_aluno']);} ?>"
                onkeydown="upperCaseF(this)"   
                >
      <!--<div class="col-lg-4">-->
      </div>
      
        <!-- LINHA PARA O BOTÃO ATUALIZAR -->
        <div class="row" style="margin-top:30px;">
            <div class="col" style="padding-left:0;">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="submit" class="btn btn-primary mb-2" value="Atualizar">                   
                    <input type="button" class="btn btn-primary mb-2" value="Limpar" onClick="limpar()"> 
                </div>                                                
            </div>
            
        <!-- FIM LINHA BOTÃO ATUALIZAR -->
        </div> 

  <!--div class="row"-->
  </div>

</form>

<br>

<!-- MONTAR A TABELA -->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nome</th>      
      <th scope="col">Nascimento</th>           
      <th scope="col">Nome Mãe</th> 
      <th scope="col">Nome do Pai</th>
      <th scope="col"></th> 
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $row) : ?> 
    <tr>  
      <td><?php echo $row['nome_aluno']; ?></td>
      <td><?php echo date('d-m-Y', strtotime($row['nascimento'])); ?></td>
      <td><?php echo $row['nome_mae']; ?></td> 
      <td><?php echo $row['telefone_pai']; ?></td>
      <td> <a href="<?php echo URLROOT; ?>/buscaalunos/ver/<?php echo $row['aluno_id']; ?>" class="fa fa-eye btn btn-success btn-lg"></a></td>
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