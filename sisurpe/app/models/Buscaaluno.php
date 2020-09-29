<?php
  class Buscaaluno extends Pagination{
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }

    //FUNÇÃO QUE EXECUTA A SQL PAGINATE
    public function getDados($page, $options){ 
        //var_dump($options);
        
      

        $sql = ("SELECT * FROM aluno WHERE 1");

        if(!empty($options['named_params'][':nome_aluno'])){
          $sql .= " AND nome_aluno LIKE " . "'%" . $options['named_params'][':nome_aluno'] . "%'";
        }

        
        $sql .= " ORDER BY nome_aluno ASC";        

        $paginate = new pagination($page, $sql, $options);
        return  $paginate;
    }  
    
    //FUNÇÃO QUE EXECUTA A SQL PAGINATE
    public function getFilaTodos($page, $options){              
        $paginate = new pagination($page, "SELECT * FROM fila ORDER BY id", $options);
        return  $paginate;
    }
    
   

    

  } 

?>