<?php
  class Transporte {
    private $db;

    public function __construct(){
        $this->db = new Database;        
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
    
    public function getLinhasAlunoById($id){
        $this->db->query("SELECT linhas.linha , aluno_linhas.aluno_id,aluno_linhas.id, linhas.rota FROM aluno_linhas, linhas WHERE aluno_id = :aluno_id AND aluno_linhas.linha_id = linhas.id AND ano = YEAR(NOW()) ORDER BY linha_id ASC");
        $this->db->bind(':aluno_id',$id); 
        $result = $this->db->resultSet(); 
        if($this->db->rowCount() > 0){
            return $result;
        } else {
            return false;
        }           
    }  

    public function register($data){       
        $this->db->query('INSERT INTO aluno_linhas SET
                                            linha_id  = :linha_id,
                                            aluno_id = :aluno_id
                                                          
                                        '
                        );
                  
        // Bind values
        $this->db->bind(':linha_id',$data['linha']);
        $this->db->bind(':aluno_id',$data['aluno_id']);  
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteAlunoLinhas($id){
        //die($id);
        $this->db->query('DELETE FROM aluno_linhas WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->execute();

        // Check row
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function getDadosAlunoLinha($id){         
        $this->db->query("SELECT aluno.user_id as user_id, aluno_linhas.aluno_id as aluno_id FROM aluno_linhas, aluno WHERE aluno_linhas.aluno_id = aluno.aluno_id AND aluno_linhas.id = :id");
        $this->db->bind(':id',$id); 
        $result = $this->db->single(); 
        if($this->db->rowCount() > 0){
            return $result;
        } else {
            return false;
        }           
    }  

    public function checkAlunoLinha($aluno_id,$linha_id){
        $this->db->query("SELECT * FROM aluno_linhas WHERE aluno_id = :aluno_id AND linha_id = :linha_id AND ano = YEAR(NOW())");
        $this->db->bind(':aluno_id',$aluno_id);
        $this->db->bind(':linha_id',$linha_id);  
        $result = $this->db->single(); 
        if($this->db->rowCount() > 0){
            return $result;
        } else {
            return false;
        }           

    }
    
    

}