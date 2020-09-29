<?php
  class Anual {
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }

    public function getDadosAnuaisByid($id){
        $this->db->query('SELECT * FROM dados_anuais WHERE aluno_id = :aluno_id AND ano = YEAR(NOW())');
        // Bind value
        $this->db->bind(':aluno_id', $id);

        $data = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0){
            return $data;
        } else {
            return false;
        }
    }


    

    public function getUltimaAtualizacaoById($id){
        $this->db->query('SELECT ultima_atual FROM dados_anuais WHERE aluno_id = :aluno_id');
        // Bind value
        $this->db->bind(':aluno_id', $id);

        $data = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0){
            return $data;
        } else {
            return false;
        }
    }

    public function getEscolas(){
        $this->db->query("SELECT * FROM escola ORDER BY nome DESC"); 
        $result = $this->db->resultSet(); 
        if($this->db->rowCount() > 0){
            return $result;
        } else {
            return false;
        }           
    }

    public function getLinhas(){
        $this->db->query("SELECT * FROM linhas ORDER BY linha ASC"); 
        $result = $this->db->resultSet(); 
        if($this->db->rowCount() > 0){
            return $result;
        } else {
            return false;
        }           
    }

    public function getEtapas(){
        $this->db->query("SELECT * FROM etapa ORDER BY descricao DESC"); 
        $result = $this->db->resultSet(); 
        if($this->db->rowCount() > 0){
            return $result;
        } else {
            return false;
        }           
    }


    public function getAlunoById($id){
        $this->db->query("SELECT * FROM aluno WHERE aluno_id = :aluno_id"); 
        // Bind value
        $this->db->bind(':aluno_id', $id);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0){
            return $row;
        } else {
            return false;
        }
    }

    



    public function register($data){
        $this->db->query('INSERT INTO dados_anuais SET
                                            aluno_id  = :aluno_id ,
                                            escola_id = :escola_id, 
                                            etapa_id = :etapa_id,                                                                                       
                                            kit_inverno = :kit_inverno, 
                                            kit_verao = :kit_verao,                                            
                                            tam_calcado = :tam_calcado, 
                                            turno = :turno                   
                                        '
                        );
                  
        // Bind values
        $this->db->bind(':aluno_id',$data['aluno_id']);  
        $this->db->bind(':escola_id',$data['escola_id']); 
        $this->db->bind(':etapa_id',$data['etapa_id']);             
        $this->db->bind(':kit_inverno',$data['kit_inverno']);
        $this->db->bind(':kit_verao',$data['kit_verao']);       
        $this->db->bind(':tam_calcado',$data['tam_calcado']);       
        $this->db->bind(':turno',$data['turno']);       


        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }




    public function update($data){
        $this->db->query('UPDATE dados_anuais SET 
                                            aluno_id  = :aluno_id ,
                                            escola_id = :escola_id, 
                                            etapa_id = :etapa_id,                                                                                       
                                            kit_inverno = :kit_inverno, 
                                            kit_verao = :kit_verao,                                          
                                            tam_calcado = :tam_calcado, 
                                            turno = :turno  
                                            WHERE aluno_id = :aluno_id');
                  
        // Bind values
        $this->db->bind(':aluno_id',$data['aluno_id']);  
        $this->db->bind(':escola_id',$data['escola_id']); 
        $this->db->bind(':etapa_id',$data['etapa_id']);             
        $this->db->bind(':kit_inverno',$data['kit_inverno']);
        $this->db->bind(':kit_verao',$data['kit_verao']);       
        $this->db->bind(':tam_calcado',$data['tam_calcado']);       
        $this->db->bind(':turno',$data['turno']);       
              


        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


   
    public function addLinhaAluno($linha,$aluno_id){
        // se o estado vim vazio já retorno falso e trato a menságem no controller
         if(empty($linha)){
             return false;
         }

         $this->db->query('INSERT INTO aluno_linhas (linha_id, aluno_id) VALUES (:linha, :aluno_id)');
         // Bind values
         $this->db->bind(':linha',$linha); 
         $this->db->bind(':aluno_id',$aluno_id);   
         // Execute
         if($this->db->execute()){
             return true;
         } else {
             return false;
         }

     }






    

    
    

  }