<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">        
            <div class="card card-body bg-light mt-5">
                <?php // Segunda parte da menságem        
                flash('mensagem_erro');
                ?>
                <h2>Recuperação de senha</h2>
                <p>Por favor informe seu email</p>                               
                <form action="<?php echo URLROOT; ?>/users/enviasenha" method="post" enctype="multipart/form-data" onsubmit="return validation(
                                                                                                                                            [noempty=['password']],
                                                                                                                                            [validemail=['email']]
                                                                                                                                            )">
                
                
                 <!--EMAIL-->
                 <div class="form-group">   
                        <label 
                            for="email">Email: <sup>*</sup>
                        </label>                        
                        <input 
                            type="text" 
                            name="email" 
                            class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"                             
                            placeholder="Informe seu email",
                            value="<?php echo $data['email'];?>"
                        >
                        <span class="invalid-feedback">
                            <?php echo $data['email_err']; ?>
                        </span>
                    </div>


                    <!--BUTTONS-->
                    <div class="row">
                        <div class="col">
                            <?php  submit('Eviar a senha para meu e-mail'); ?>                            
                        </div>                         
                    </div>                      
                </form>                
            </div>
        </div>
        
<?php require APPROOT . '/views/inc/footer.php'; ?>
