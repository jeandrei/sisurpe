<?php 
function imprimeuf($ufsec){
$arrayEstados = array(
    'AC',
    'AL',
    'AM',
    'AP',
    'AC',
    'BA',
    'CE',
    'DF',
    'ES',
    'GO',
    'MA',
    'MT',
    'MS',
    'MG',
    'PA',
    'PB',
    'PR',
    'PE',
    'PE',
    'PI',
    'RJ',
    'RN',
    'RN',
    'RO',
    'RS',
    'RR',
    'SC',
    'SE',
    'SP',
    'TO' 
  );  
  foreach($arrayEstados as $uf){ 
    //iduf tem que ser passada pelo post
    if($uf == $ufsec){
      $html .= '<option selected value="'.$uf.'" '.'>'.$uf.'</option>';
    }
    else{
    $html .='<option value="'.$uf.'" '.'>'.$uf.'</option>';           

  }

}
return $html;
}


function imptamanhounif($tamanhosec){
  $arrayTamanhos = array(
      '1',
      '2',
      '3',
      '4',
      '5',
      '6',
      '7',
      '8',
      'P',
      'M',
      'G',
      'GG',
      'EG',      
    );  
    foreach($arrayTamanhos as $tamanho){ 
      //idtamanho tem que ser passada pelo post
      if($tamanho == $tamanhosec){
        $html .= '<option selected value="'.$tamanho.'" '.'>'.$tamanho.'</option>';
      }
      else{
      $html .='<option value="'.$tamanho.'" '.'>'.$tamanho.'</option>';           
  
    }
  
  }
  return $html;
  }


  function imptlinhastransporte($linhasec){
    $arrayLinhas = array(
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        'ARMAÇÃO',
        'SANTA LIDIA',
        'TESTE',              
      );  
      foreach($arrayLinhas as $linha){ 
        //idtamanho tem que ser passada pelo post
        if($linha == $linhasec){
          $html .= '<option selected value="'.$linha.'" '.'>'.$linha.'</option>';
        }
        else{
        $html .='<option value="'.$linha.'" '.'>'.$linha.'</option>';           
    
      }
    
    }
    return $html;
    }


function validaCPF($cpf) {
 
  // Extrai somente os números
  $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
   
  // Verifica se foi informado todos os digitos corretamente
  if (strlen($cpf) != 11) {
      return false;
  }
  // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
  if (preg_match('/(\d)\1{10}/', $cpf)) {
      return false;
  }
  // Faz o calculo para validar o CPF
  for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
          $d += $cpf{$c} * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf{$c} != $d) {
          return false;
      }
  }
  return true;
}

function validacelular($celular){
if (preg_match('/(\(?\d{2}\)?) ?9?\d{4}-?\d{4}/', $celular)) {
  return true;
} else {
  return false;
}
}


function validanascimento($data){
$formatado = date('Y-m-d',strtotime($data));
$ano = date('Y', strtotime($formatado));
$mes = date('m', strtotime($formatado));
$dia = date('d', strtotime($formatado));
$anominimo = date('Y', strtotime('-5 year'));

if ( !checkdate( $mes , $dia , $ano )                   // se a data for inválida
     || $ano < $anominimo                                // ou o ano menor que a data mínima
     || mktime( 0, 0, 0, $mes, $dia, $ano ) > time() )  // ou a data passar de hoje
  {
    return false;
  }else{
    return true;
  }
}


function html($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
	return $data;
}

function htmlout($text)
{
	echo html($text);
}

function valida($data){  
  
  if(empty($data)){
    return false;
  }
  
  // se a data for maior que a data atual retorna falso
  if($data > date("Y-m-d")){
    return false;
  }

  $tempDate = explode('-', $data);
  if(checkdate($tempDate[1], $tempDate[2], $tempDate[0])){
    return true;
  } else {
    return false;
  }  
}



function formatadata($data){  
  $result = date('d/m/Y', strtotime($data));    
  return $result;
}


function validaemail($email){
  if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    return true;
  } else {
    return false;
  }
  

}


function RandomPassword($length = 6){
  $chars = "0123456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ";
  return substr(str_shuffle($chars),0,$length);
}






?>