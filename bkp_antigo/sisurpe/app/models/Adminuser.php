<?php

class Adminuser extends Pagination{
    private $db;

    public function __construct(){
        //inicia a classe Database
        $this->db = new Database;
    }    

   //FUNÇÃO QUE EXECUTA A SQL PAGINATE
   public function getUsers($page, $options){   
  
        $sql = ("SELECT id,name,email,type,created_at FROM users WHERE 1");

        if(!empty($options['named_params'][':name'])){
        $sql .= " AND name LIKE " . "'%" . $options['named_params'][':name'] . "%'";
        }

        
        $sql .= " ORDER BY name ASC";        

        $paginate = new pagination($page, $sql, $options);
        return  $paginate;
    }
    
    
    public function update($id, $type){       
        $this->db->query('UPDATE users SET users.type=:type WHERE id=:id');              
        $this->db->bind(':id',$id); 
        $this->db->bind(':type',$type); 
       // Execute
       if($this->db->execute()){
            return true;
        } else {
            return false;
        }       

    }



//class
}
?>