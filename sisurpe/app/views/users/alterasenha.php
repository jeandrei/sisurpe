<?php require APPROOT . '/views/inc/header.php';?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-2">
                <h2>Alterar a Senha</h2>
                <p>Por favor informe sua nova senha</p> 
                <form action="<?php echo URLROOT; ?>/users/alterasenha" method="post" enctype="multipart/form-data" onsubmit="return validation(
                                                                                                                                               [noempty=['name']],
                                                                                                                                             )">   
                                         
                     <!--PASSWORD-->
                     <div class="form-group">   
                        <label 
                            for="password">Senha: <sup>*</sup>
                        </label>                        
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Informe sua senha",
                            class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"                             
                            value="<?php echo $data['password'];?>"
                        >
                        <span class="invalid-feedback">
                            <?php echo $data['password_err']; ?>
                        </span>
                    </div>

                    <!--CONFIRM PASSWORD-->
                    <div class="form-group">   
                        <label 
                            for="confirm_password">Confirme a Nova Senha: <sup>*</sup>
                        </label>                        
                        <input 
                            type="password" 
                            name="confirm_password" 
                            placeholder="Informe sua senha",
                            class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>"                             
                            value="<?php echo $data['confirm_password'];?>"
                        >
                        <span class="invalid-feedback">
                            <?php echo $data['confirm_password_err']; ?>
                        </span>
                    </div>


                    
                    <!--BUTTONS-->
                    <div class="row">
                        <div class="col">                            
                           <?php  submit('Salvar'); ?>                           
                        </div>                        
                    </div>

                </form>
            </div>
        </div>
    </div>   
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>  
    //ADICIONA MASCARA DE CPF
    addclass('cpf','cpfmask');     
</script>