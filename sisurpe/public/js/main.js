jQuery.validator.addMethod("cpf", function(value, element) {
  value = jQuery.trim(value);

   value = value.replace('.','');
   value = value.replace('.','');
   cpf = value.replace('-','');
   while(cpf.length < 11) cpf = "0"+ cpf;
   var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
   var a = [];
   var b = new Number;
   var c = 11;
   for (i=0; i<11; i++){
       a[i] = cpf.charAt(i);
       if (i < 9) b += (a[i] * --c);
   }
   if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
   b = 0;
   c = 11;
   for (y=0; y<10; y++) b += (a[y] * c--);
   if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

   var retorno = true;
   if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

   return this.optional(element) || retorno;

}, "Informe um CPF válido");



//** ***************************************FIM VALIDAÇÕES ******************************************************************** */

function confirmasenha(senha,confirma){
  if(senha != "" && confirma != ""){
    if(senha != confirma){      
      return false;
    } else {
      return true;
    }
  } else { 
    return false;
  }  
}

function validaemail(email)
	{
	  er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
	  
	  if(er.exec(email))
		{
		  return true;
		} else {
		  return false;
		}
	}


//função para validar telefona
function validatetelefone(txtPhone) {
  var a = txtPhone;
  var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
  if (filter.test(a)) {
      return true;
  }
  else {
      return false;
  }
}


//****************VALIDAÇÃO DE CPF******************* */
function validacaocpf(cpf) {	
	cpf = cpf.replace(/[^\d]+/g,'');	
	if(cpf == '') return false;	
	// Elimina CPFs invalidos conhecidos	
	if (cpf.length != 11 || 
		cpf == "00000000000" || 
		cpf == "11111111111" || 
		cpf == "22222222222" || 
		cpf == "33333333333" || 
		cpf == "44444444444" || 
		cpf == "55555555555" || 
		cpf == "66666666666" || 
		cpf == "77777777777" || 
		cpf == "88888888888" || 
		cpf == "99999999999")
			return false;		
	// Valida 1o digito	
	add = 0;	
	for (i=0; i < 9; i ++)		
		add += parseInt(cpf.charAt(i)) * (10 - i);	
		rev = 11 - (add % 11);	
		if (rev == 10 || rev == 11)		
			rev = 0;	
		if (rev != parseInt(cpf.charAt(9)))		
			return false;		
	// Valida 2o digito	
	add = 0;	
	for (i = 0; i < 10; i ++)		
		add += parseInt(cpf.charAt(i)) * (11 - i);	
	rev = 11 - (add % 11);	
	if (rev == 10 || rev == 11)	
		rev = 0;	
	if (rev != parseInt(cpf.charAt(10)))
		return false;		
	return true;   
}
//**********************FIM FUNÇÃO VALIDAÇÃO DE CPF */


// FUNÇÃO PARA ADICIONAR CLASSE
// função para adicionar nova classe a objetos
// exemplo para adicionar a classe cpf que tem a mascara do cpf
// no final do formulário basta colocar
// <script>  addclass('cpf','cpf'); </script>
// onde id é o id do campo e new class é a nova classe a ser adicionada neste caso cpfmask que coloca mascara no cpf
function addclass(id,newclass){
  var element = document.getElementById(id);
  var addclass = newclass;
  element.classList.add(addclass);
}

// FUNÇÃO PARA COLOCAR TUDO EM MAIÚSCULO
// onkeydown="upperCaseF(this)" 
function upperCaseF(a){
  setTimeout(function(){
      a.value = a.value.toUpperCase();
  }, 1);
}


//FUNÇÃO PARA PERMITIR APENAS NÚMEROS
//PARA USAR BASTA COLOCAR O CAMPO COMO CLASSE onlynumbers
//E PARA EXIBIR A MENSAGEM COLOCAR UM <span id="errmsg"></span>
//USE TAMBÉM O TIPO NUMBER NO INPUT type="number" 
$(document).ready(function () {
	//called when key is pressed in textbox
	$(".onlynumbers").keypress(function (e) {
	   //if the letter is not digit then display error and don't type anything
	   if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		  //display error message
		  alert("Ops! Apenas números são permitidos.");
				 return false;
	  }
	 });
  });




//mascaras para os formulários todas se aplicam a classe
// no caso de aplicar mascara a telefone é só 
//fazer <input type="tel" class="telefone"
//vai aplicar somente depois de carregar o documento 
//por isso esta dentro da (document).ready()
//tem que colocar o footer que está neste projeto para lincar com maskedinput.min.js
$(document).ready(function() {
	$('.cpfmask').mask('000.000.000-00', {reverse: true});
	$(".telefone").mask("(00) 00000-0009");
	});
//********************fim mascaras**************** */


function CheckForm(id){
	var checked=false;
	var elements = document.getElementsByName(id);
	for(var i=0; i < elements.length; i++){
		if(elements[i].checked) {
			checked = true;
		}
	}
	if (!checked) {
		checked = false;
	}
	return checked;
}

function checkedRadioBtn(sGroupName)
    {   
        var group = document.getElementsByName(sGroupName);

        for ( var i = 0; i < group.length; i++) {
            if (group.item(i).checked) {
                return group.item(i).id;
            } else if (group[0].type !== 'radio') {
                //if you find any in the group not a radio button return null
                return null;
            }
        }
	}
	
	function question(ask)
	{
		return confirm (ask);
	}

