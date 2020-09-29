<?php
  // Simple page redirect
function redirect($page){
    header('location: ' . URLROOT . '/' . $page);
}



// GERA INPUT TEXT OU PASSWORD
function text($attributes) {?>   
  <div class="<?php echo isset($attributes['div_class']) ? $attributes['div_class'] : 'form-group';?>">
      
      <label for="<?php echo $attributes['id']; ?>"><?php echo $attributes['label']; ?></label>
      
      <input 
          type="<?php echo $attributes['type']; ?>" 
          name="<?php echo $attributes['name']; ?>" 
          id="<?php echo $attributes['id']; ?>" 
          placeholder="<?php echo $attributes['placeholder']; ?>"
          class="<?php echo isset($attributes['input_class']) ? $attributes['input_class'] : 'form-control form-control-lg';?>"           
          value="<?php echo isset($_POST[$attributes['name']]) ? ($_POST[$attributes['name']]) : ''; ?>"          
      >
      
      <label for="<?php echo $attributes['name'];?>" class="error"><?php echo $attributes['error'];?></label>
    
  </div>
<?php                               
}//fim função text



  function submit($value = 'submit', $class = 'btn btn-success btn-block') {?>
    <button type="submit" class="<?php echo $class; ?>"><?php echo $value; ?></button>
  <?php }






  function linkbutton($link, $text, $class = 'btn btn-light btn-block') {?>
    <a href="<?php echo $link; ?>" class="btn btn-light btn-block"><?php echo $text; ?></a>  
  <?php } 