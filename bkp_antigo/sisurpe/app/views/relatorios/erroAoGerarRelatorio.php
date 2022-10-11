
<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="alert alert-warning" role="alert">
    <?php echo $data["erro"];?>
</div>

<br>

<!--BOTÃO VOLTAR-->
<div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-2">
        <a href="<?php echo URLROOT .  $data["link"]?>" id="voltar" class="btn btn-default btn-block" style="background-color:#FFFAF0">
            <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
        </a>
        
    </div>
</div>    


<?php require APPROOT . '/views/inc/footer.php'; ?>