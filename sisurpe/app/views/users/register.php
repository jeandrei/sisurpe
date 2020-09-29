<?php require APPROOT . '/views/inc/header.php';?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-2">
                <h2>Criar uma conta</h2>
                <p>Por favor preencha os dados abaixo para se registrar</p> 
                <form action="<?php echo URLROOT; ?>/users/register" method="post" enctype="multipart/form-data" onsubmit="return validation(
                                                                                                                                               [noempty=['name']],
                                                                                                                                           [validaradio=['moradia']]                                                                                                                                               
                                                                                                                                               )">   
                    
                    <?php
                         //Nome                        
                        text($attributes = [
                          'id' => 'name',
                          'name' => 'name',
                          'type' => 'text',
                          'label' => '<b class="obrigatorio">* </b>Nome',
                          'placeholder' => 'Informe um nome',                          
                          'error' => $data['name_err'] = ""
                      ]);
                        
                        
                        //EMAIL                       
                        text($attributes = [
                          'id' => 'email',
                          'name' => 'email',
                          'type' => 'text',
                          'label' => '<b class="obrigatorio">* </b>Email',
                          'placeholder' => 'Informe um email válido',                          
                          'error' => $data['email_err']
                      ]);
                        
                        
                        //PASSWORD                        
                        text($attributes = [
                          'id' => 'password',
                          'name' => 'password',
                          'type' => 'password',
                          'label' => '<b class="obrigatorio">* </b>Senha',
                          'placeholder' => 'Informe uma senha de 6 caracteres',                          
                          'error' => $data['password_err'] = ""
                      ]);
                        
                        //CONFIRM PASSWORD                       
                        text($attributes = [
                          'id' => 'confirm_password',
                          'name' => 'confirm_password',
                          'type' => 'password',
                          'label' => '<b class="obrigatorio">* </b>Confirme a Senha',
                          'placeholder' => 'Confirme a senha',                          
                          'error' => $data['confirm_password_err'] = ""
                      ]);
                         
                          
                    ?>





                    
                    <!--BUTTONS-->
                    <div class="row">
                        <div class="col">                            
                           <?php  submit('Registrar-se'); ?>                           
                        </div>
                        <div class="col">                            
                            <?php linkbutton(URLROOT.'/users/login', 'Já tem uma conta? Login'); ?>
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