<html>
<head>
	<meta charset="utf-8">
</head>
<script type="text/javascript">

window.onload=function () {

	var inputs = document.getElementsByTagName('input');
	
	codigo 		= null;
	categoria 	= null;
	
	i = inputs.length-1;
	while(i >=0){
		name = inputs[i].getAttribute('name');

		//Pegar o Id do produto que esta sendo editado
		if (name == 'codigo') {
			inputs[i].onfocus=function(){
				alert('este campo não pode ser alterado');
				this.setAttribute('disabled','disabled');
			}
			inputs[i].onblur=function(){
				this.removeAttribute('disabled');
			}
		};
		i--;
	}//fecha while

	dataAtual = new Date();
	da = dataAtual.setDate(18); //dia atual
	ma = dataAtual.setMonth(4); //mes atual
	aa = dataAtual.setFullYear(2014); //ano atual
	ha = dataAtual.setHours(12); //hora atual
	mia = dataAtual.setMinutes(00); //min atual

	getAm = dataAtual.getMonth();
	getAd = dataAtual.getDate();
	getAa = dataAtual.getFullYear();
	getAh = dataAtual.getHours();
	getAmi = dataAtual.getMinutes();

	dataFinal = new Date();
	df = dataAtual.setDate(18); //dia atual
	mf = dataAtual.setMonth(5); //mes atual
	af = dataAtual.setFullYear(2014); //ano atual
	hf = dataAtual.setHours(12); //hora atual
	mif = dataAtual.setMinutes(00); //min atual

	getFm = dataAtual.getMonth();
	getFd = dataAtual.getDate();
	getFa = dataAtual.getFullYear();
	getFh = dataAtual.getHours();
	getFmi = dataAtual.getMinutes();

	if (dataAtual <= dataFinal) {
		//alert('a promoção acabou!');
	} else {
		//alert('a promoção esta rolando!');
	}

} //fecha onload

</script>

<?php
	
	//EXCLUIR =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	if (isset($_POST['excluir'])) {

	$cat 	=  $_POST['categoria'];
	$codigo = $_POST['codigo'];
	$arq 	= $cat.'.xml';

	$file 	= file_get_contents($arq);
	$dom 	= new DOMDocument;
	$dom->loadXML($file);

	$elements = $dom->getElementsByTagName('codigo');

	$valida = 0;
	foreach ($elements as $elemento) {
		$ide = $elemento->getAttribute('id');
		if ($ide == $codigo) {
			$elemento->parentNode->removeChild($elemento);
			$valida = 1;
			$dom->save($arq);
		}
	} // fecha foreach
	if ($valida == 0) {
			echo 'Não foi possível alterar o produto pois houve algum erro no cadastramento. Por favor, cadastre-o novamente.';
		}
	} else; //fecha isset excluir

	//ALTERAR =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	if (isset($_POST['alterar'])) {

		$root 	= $dom->getElementsByTagName('produtos');
		
		$codigo 	= $dom->createElement('codigo');
		$attr 		= $dom->createAttribute('id');
		$tnode 		= $dom->createTextNode($_POST['codigo']); //alterado do addPro
		$attr->appendChild($tnode);
		$codigo->appendChild($attr);

	} else; //fecha isset alterar

?>

<body>
	<div id="resp"></div>
	<form method="POST">
		<input type="hidden" name="codigo" value="id_26928">

		<label>Categoria</label>
		<input type="text" name="categoria" value="sapatos">

		<label>Nome do Produto</label>
		<input type="text" name="nomeProduto">

		<label>Cor</label>
		<input type="text" name="subcat[]">

		<label>Tamanho</label>
		<input type="text" name="subcat[]">

		<label>Estilo</label>
		<input type="text" name="subcat[]">

		<label>Estacao</label>
		<input type="text" name="subcat[]">

		<button name="alterar" value="alterar">ALTERAR</button>
		<button type="submit" name="excluir">EXCLUIR</button>
	</form>
</body>
</html>