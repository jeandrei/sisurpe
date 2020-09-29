<?php
  class Buscadadostransporte extends Pagination{
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }

    //FUNÇÃO QUE EXECUTA A SQL PAGINATE
    public function getDados($page, $options, $imprimir=0){ 
        //var_dump($options);
        
    
        //$paginate = new pagination($page, "SELECT * FROM aluno WHERE nome_aluno LIKE " . "'%" . $options['named_params'][':nome'] . "%'", $options);       
        $sql = ("SELECT 
                  aluno.nome_aluno as nome_aluno,
                  aluno.nascimento as nascimento_aluno,
                  linhas.linha as linha,                
                  escola.nome as escola,
                  etapa.descricao as etapa,
                  dados_anuais.turno as turno,
                  aluno_linhas.ano as ano
                FROM 
                  aluno,dados_anuais, 
                  aluno_linhas, linhas, 
                  escola, etapa 
                WHERE 
                  aluno.aluno_id = dados_anuais.aluno_id 
                AND 
                  aluno.aluno_id = aluno_linhas.aluno_id 
                AND 
                  aluno_linhas.linha_id = linhas.id              
                AND 
                  dados_anuais.escola_id = escola.id
                AND
                  dados_anuais.etapa_id = etapa.id
                "
              );

        

        if((($options['named_params'][':linha_id']) != "NULL") && (($options['named_params'][':linha_id']) != "")  ){                  
          $sql .= " AND aluno_linhas.linha_id = " . $options['named_params'][':linha_id'];
        }

        if((($options['named_params'][':escola_id']) != "NULL") && (($options['named_params'][':escola_id']) != "")  ){                  
          $sql .= " AND dados_anuais.escola_id = " . $options['named_params'][':escola_id'];
        }

        if((($options['named_params'][':etapa_id']) != "NULL") && (($options['named_params'][':etapa_id']) != "")  ){                  
          $sql .= " AND dados_anuais.etapa_id = " . $options['named_params'][':etapa_id'];
        }

        if((($options['named_params'][':turno']) != "NULL") && (($options['named_params'][':turno']) != "")  ){                  
          $sql .= " AND dados_anuais.turno = " . "'" . $options['named_params'][':turno'] . "'";
        }


        if(!empty($options['named_params'][':nome'])){
          $sql .= " AND nome_aluno LIKE " . "'%" . $options['named_params'][':nome'] . "%'";
        }

        if(!empty($options['named_params'][':ano'])){                  
          $sql .= " AND dados_anuais.ano = " . $options['named_params'][':ano'];
        }

        $sql .= " ORDER BY linha,escola,etapa,nome_aluno ASC"; 

        //SE NÃO FOR PARA IMPRIMIR FORMULÁRIO ELE CHAMA A PAGINAÇÃO
        if($imprimir==0){
          $paginate = new pagination($page, $sql, $options);
          return  $paginate;
        } else {
            $this->db->query($sql);     
            $data = $this->db->resultSet();            
            // Check row
            if($this->db->rowCount() > 0){
                return $data;
            } else {
                return false;
            }
        }
    }  
    
    //FUNÇÃO QUE EXECUTA A SQL PAGINATE
    public function getFilaTodos($page, $options){              
        $paginate = new pagination($page, "SELECT * FROM fila ORDER BY id", $options);
        return  $paginate;
    }
    
    public function getTotais(){
                            $sql = ("SELECT 
                                      aluno_linhas.aluno_id as id_aluno_linha, 
                                      aluno.nome_aluno as nome_aluno,
                                      dados_anuais.turno as turno,
                                      escola.nome as escola,
                                      etapa.descricao as etapa
                                    FROM 
                                      aluno_linhas, 
                                      aluno,
                                      dados_anuais,
                                      escola,
                                      etapa
                                    WHERE 
                                      aluno_linhas.aluno_id = aluno.aluno_id
                                    AND
                                      dados_anuais.aluno_id = aluno.aluno_id
                                    AND
                                      dados_anuais.escola_id = escola.id
                                    AND
                                      dados_anuais.etapa_id = etapa.id
                                    GROUP BY 
                                      id_aluno_linha,
                                      turno,
                                      escola,
                                      etapa
                                    ORDER BY
                                      escola,
                                      etapa,
                                      nome_aluno                                    
                                    "
                                  );

        //$this->db->bind(':fila_id',$id);
        $this->db->query($sql);     
    
        $result = $this->db->resultSet();
        
        //verifica se obteve algum resultado
        if($result >0)
        {
            return $result;
        }
        else
        {
            return false;
        }  
    }
    

  } 

?>