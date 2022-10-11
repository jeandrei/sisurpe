<?php

require APPROOT . '/inc/fpdf/fpdf.php'; 

//die(var_dump($data));

class PDF extends FPDF
{            
            
            // Page header
            function Header()
            {   $currentdate = date("d-m-Y");
                // Logo
                $this->Image(APPROOT . '/views/relatorios/logo.png',10,6,110);
                // Date
                $this->SetFont('Arial','B',10); 
                $this->Cell(120);
                $this->Cell(260,10, utf8_decode('Data de impressão:' . $currentdate),0,0,'C');                
                // Arial bold 15
                $this->SetFont('Arial','B',15);    
                // Title
                $this->Ln(20);
                // Move to the right
                $this->Cell(120);
                $this->Cell(30,10, utf8_decode("Listagem do Transporte Escolar"),0,0,'C');
                // Line break
                $this->Ln(20);                
            }

            // Page footer
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Page number
                $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');                
            }
}

            // Instanciation of inherited class
            $pdf = new PDF();
            //define o tipo e o tamanho da fonte                                  
            $pdf->SetFont('Arial','B',8);
            //defino as colunas do relatório
            $colunas =array("N","Nome do Aluno","linha", "Etapa", "Turno");
            //largura das colunas
            $larguracoll = array(1 => 5, 2 => 110, 3 => 90, 4 => 40, 5 => 10, 6 => 10);
            //tamanho da fonte
            $left = 5; 
           
            
           //defino a variável linha como em branco pois depois faço a verificação se for diferente da linha do array crio uma nova página
           //para a outra linha 
           $linha="";
           $countlinha=1; 
           $countgeral=0;
           // os dados de $data vem do controller através da função getDados($page, $options,1) em que 1 quer dizer que é para impressão
           // e 0 é para listar dessa forma lá no model consigo utilizar a mesma função para trazer exatamente o mesmo resultado da pesquisa
           // quando zero retorno o paginate quando 1 retorno todos os valores como uma consulta sql normal         
           if(!empty($data)){
                    foreach($data as $row){
                        $countlinha++; 
                        $countgeral++;
                        // aqui se $ linha for diferente de $row->linha quer dizer que é uma nova linha então crio uma
                        // nova página $pdf->AddPage('L') com as informações da linha e listo as linhas dessa linha
                        if($escola != $row->escola){  
                            $escola = $row->escola;                           
                            $pdf->AddPage('L');
                            //SETA A FONTE PARA TAMANHO 8 NEGRITO
                            $pdf->SetFont('Arial','B',12);
                            $pdf->Cell(0, 5,"Escola: " . utf8_decode($row->escola), 0, 1, "C");
                            $countlinha=1;                       
                            $pdf->Ln();
                            // COLUNAS
                            //adiciona uma nova pagina                            
                            //SETA A FONTE PARA TAMANHO 8 NEGRITO
                            $pdf->SetFont('Arial','B',12);                                              
                            
                            $i=0;
                            foreach($colunas as $coluna){
                                $i++;
                                $pdf->SetFont('Arial','B',8);                   
                                $pdf->Cell($larguracoll[$i],$left,utf8_decode($coluna),1);
                                
                            }
                                $pdf->Ln();                                
                                
                        } 
                        $pdf->Cell($larguracoll[1],$left,utf8_decode($countlinha),1);                     
                        $pdf->Cell($larguracoll[2],$left,utf8_decode($row->nome_aluno),1); 
                        $pdf->Cell($larguracoll[3],$left,utf8_decode($row->escola),1);
                        $pdf->Cell($larguracoll[4],$left,utf8_decode($row->etapa),1);
                        $pdf->Cell($larguracoll[5],$left,utf8_decode($row->turno),1);                                                                    
                        
                        //linha nova
                        $pdf->Ln();
                        
                        

                    }//END FOREACH 
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',16);
                    $pdf->Cell(40,10,"Total: ".utf8_decode($countgeral),0,0,'C');

                    if($pdf->Output())
                    {
                        $pdf->Output("Relatorio.pdf",'I');  
                    }
                    else{                
                        echo $data['erro'] = $error;
                        $this->view('relatorios/erroAoGerarRelatorio',$data);
                        
                    }   
           } else{                
            $data['erro'] = "Sem dados para emitir";
            $data['link'] = "/buscadadostransportes";
            $this->view('relatorios/erroAoGerarRelatorio', $data); 
           }       
?>

