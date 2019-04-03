//Ajax Capacidade de carro
function buscarPlaca(){
	var id = document.getElementById("veiculo").value;
	$.post('ações/capacidade.php',
	{buscarPlaca: 'buscarPlaca', placa: id},
	function (data){
		$('#resultado').html(data);
	});
}

//Ajax Buscar Escolas
function buscaEscola(){
	var id = document.getElementById("locais").value;
}

//Escolha de Turno
function turno(){
	var manha = document.getElementById("manha").checked;
	var tarde = document.getElementById("tarde").checked;
	if(!manha && !tarde){
		alert('Selecione algum turno!');
		document.getElementById("manha").focus();
		return false;
	}else
		return true;
	
		
}

//Cadastro de Intinerário
function capacidadeVeiculo(){

	var quantidade = document.getElementById("quantidade").value;
	var capacidade = document.getElementById("capacidade").value;
	
	
	if(quantidade > capacidade){
		escola = confirm('A Quantidade de alunos é superior que a capacidade do veículo!\n Deseja continuar com o cadastro?');
		if(escola)
			return true;
		else{
			document.getElementById("quantidade").focus();
			return false;
		}

	}
	
}

//Habilitando mês da quilometragem
function Km(){
	var km = document.getElementById("antigo").value;
	if(km){
		document.getElementById("mes").removeAttribute('disabled'); // Desabilitar
		document.getElementById("ano").removeAttribute('disabled'); // Desabilitar
		document.getElementById("mes").setAttribute('required', 'required'); // Habilitar
		document.getElementById("ano").setAttribute('required', 'required'); // Habilitar
		
	}
}
function Km2(){
	var Km2 = document.getElementById("atual");
	if(Km2){
		document.getElementById("mes").setAttribute('disabled', 'disabled'); // Habilitar
		document.getElementById("ano").setAttribute('disabled', 'disabled'); // Habilitar
		document.getElementById("mes").removeAttribute('required'); // Desabilitar
		document.getElementById("ano").removeAttribute('required'); // Desabilitar
	}
}
