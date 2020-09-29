<?php
  class Buscadadosescolar extends Pagination{
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }

    //FUNÇÃO QUE EXECUTA A SQL PAGINATE
    public function getDados($page, $options, $imprimir=0){ 
        //var_dump($imprimir);
        
    
        //$paginate = new pagination($page, "SELECT * FROM aluno WHERE nome_aluno LIKE " . "'%" . $options['named_params'][':nome'] . "%'", $options);       
        $sql = ("SELECT 
                    aluno.nome_aluno as nome_aluno, 
                    aluno.nascimento as nascimento,
                    escola.nome as escola,
                    aluno.sexo as sexo, 
                    dados_anuais.ano as ano, 
                    dados_anuais.kit_inverno as kit_inverno, 
                    dados_anuais.kit_verao as kit_verao, 
                    dados_anuais.tam_calcado as calcado,                     
                    etapa.descricao as etapa, 
                    dados_anuais.turno as turno,
                    dados_anuais.ultima_atual as ultima_atual
                FROM 
                  aluno,dados_anuais, 
                  escola, etapa 
                WHERE 
                  aluno.aluno_id = dados_anuais.aluno_id 
                AND 
                  dados_anuais.escola_id = escola.id
                  AND 
                  dados_anuais.etapa_id = etapa.id"
              );

        

        if((($options['named_params'][':escola_id']) != "NULL") && (($options['named_params'][':escola_id']) != "")  ){                  
          $sql .= " AND escola.id = " . $options['named_params'][':escola_id'];
        }


        if((($options['named_params'][':etapa_id']) != "NULL") && (($options['named_params'][':etapa_id']) != "")  ){                  
          $sql .= " AND etapa.id = " . $options['named_params'][':etapa_id'];
        }

        if((($options['named_params'][':turno']) != "NULL") && (($options['named_params'][':turno']) != "")  ){                  
          $sql .= " AND dados_anuais.turno = " . "'" .  $options['named_params'][':turno'] . "'";
        }    

        if(!empty($options['named_params'][':nome'])){
          $sql .= " AND nome_aluno LIKE " . "'%" . $options['named_params'][':nome'] . "%'";
        }

        if((($options['named_params'][':ano']) != "NULL") && (($options['named_params'][':ano']) != "")  ){                  
          $sql .= " AND dados_anuais.ano = " . $options['named_params'][':ano'];
        } else {
          $sql .= " AND dados_anuais.ano = " . date("Y"); 
        }

        if((($options['named_params'][':sexo']) != "NULL") && (($options['named_params'][':sexo']) != "")  ){                  
          $sql .= " AND aluno.sexo = " . "'" .  $options['named_params'][':sexo'] . "'";
        } 

        if((($options['named_params'][':kit_inverno']) != "NULL") && (($options['named_params'][':kit_inverno']) != "")  ){                  
          $sql .= " AND dados_anuais.kit_inverno = " . "'" . $options['named_params'][':kit_inverno'] . "'";
        }

        if((($options['named_params'][':kit_verao']) != "NULL") && (($options['named_params'][':kit_verao']) != "")  ){                  
          $sql .= " AND dados_anuais.kit_verao = " . "'" . $options['named_params'][':kit_verao'] ."'";
        }
        

        if((($options['named_params'][':tam_calcado']) != "NULL") && (($options['named_params'][':tam_calcado']) != "")  ){                  
          $sql .= " AND dados_anuais.tam_calcado = " . $options['named_params'][':tam_calcado'];
        }        

        $sql .= " ORDER BY escola, nome_aluno ASC"; 
        //var_dump($sql);

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
    
    
    

  } 

?>