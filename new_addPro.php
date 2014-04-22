<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<?php
	
	if (isset($_POST['enviar'])) {
	
	$cat 	=  'sapatos';

	$arq 	= $cat.'.xml';
	$xml 	= simplexml_load_file($arq);

	$file 	= file_get_contents($arq);
	$dom 	= new DOMDocument('1.0', 'utf-8');
	$dom->loadXML($file);

	$root 	= $dom->getElementsByTagName('produtos');

	$codigo 	= $dom->createElement('codigo');
	
	$attr = $dom->createAttribute('id');

	$codigo->appendChild($attr);

	$tnode = $dom->createTextNode('id_'.rand());
	$attr->appendChild($tnode);

	$codigo->setIdAttribute("id",true);

	//Inserir nome do produto no XML
	$nomeProduto = $dom->createTextNode($_POST['nomeProduto']);
	$produto 	= $dom->createElement('produto');
	$produto->appendChild($nomeProduto);
	$codigo->appendChild($produto);

	$subcats = $dom->getElementsByTagName('subcat');

	//criar elementos de descrição do produto
	$ie = 0;
	while ($ie <= $subcats->length-1) {
		$e[$ie]	= $dom->createElement($subcats->item($ie)->nodeValue);
		$ie++;
	}

	//criar conteudo dos elementos
	$subcatDesc = $_POST['subcat'];

	$ic = 0;
	while ($ic <= $subcats->length-1) {
		$c[$ic] = $dom->createTextNode($subcatDesc[$ic]);
		$ic++;
	}

	//atribuir elementos dentro da tag <produtos>
	$i = 0;
	while ($i<=$subcats->length-1) {
		$e[$i]->appendChild($c[$i]);
		$codigo->appendChild($e[$i]);
		$i++;
		if ($i == $subcats->length-1) {
			$root->item(0)->appendChild($codigo);
		}
	}

	$dom->save($arq);
} else;

?>
	<form method="POST">
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

		<button type="submit" name="enviar">CADASTRAR</button>
	</form>
</body>
</html>