<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	<?php
	
	if (isset($_POST['enviar'])) {
			
			if (empty($_POST['subcat'])) {
				echo 'Selecione ao menos uma subcategoria';
			} else {

			$cat 	= $_POST['categoria'];
			$subcat = $_POST['subcat'];

			$dom 	= new DOMDocument('1.0','utf-8');
			$dom->formatOutput = true;
			
			$root 	= $dom->createElement($cat);
			$txt 	= $dom->createTextNode(' '); //necessário vazio para abrir e fechar o elemento criado corretamente
			$root->appendChild($txt);
			$dom->appendChild($root);

			$rootSub 	= $dom->createElement('subcats');

			$i = 0;
			while ($i <= sizeof($subcat)-1) {
				$subcatItem 	= $dom->createElement('subcat');
				$subcatItemTxt 	= $dom->createTextNode($subcat[$i]);

				$subcatItem->appendChild($subcatItemTxt);

				$rootSub->appendChild($subcatItem);
				$i++;
				if ($i == sizeof($subcat)-1) {
					$root->appendChild($rootSub);
				}
			}

			$rootProduto 	= $dom->createElement('produtos');
			$txtProduto		= $dom->createTextNode(' ');
			$rootProduto->appendChild($txtProduto);
			$root->appendChild($rootProduto);

			$dom->save($cat.'.xml');
			} //fecha else do empty
		} else; //fecha if de iniciaização (isset)

	?>
		<form method="POST">
			<label>Digite a Categoria:</label>
			<input type="text" value="" name="categoria">
			<label>cor</label>
			<input type="checkbox" name="subcat[]" value="cor" selected="selected">
			<label>tamanho</label>
			<input type="checkbox" name="subcat[]" value="tamanho" selected="selected">
			<label>estilo</label>
			<input type="checkbox" name="subcat[]" value="estilo" selected="selected">
			<label>estacao</label>
			<input type="checkbox" name="subcat[]" value="estacao" selected="selected">
			<button type="submit" name="enviar">ENVIAR</button>
		</form>
	</body>
</html>
