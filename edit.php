<?php
	
	$ca = $_POST['ca'];
	
	$cat 	=  $_POST['categoria'];
	$codigo = $_POST['codigo'];

	echo $ca;
	echo $cat;

	if ($cat != 'sapatos') {
		echo $cat;
		echo $ca;
		echo 'voce mudou a categoria';
	} else {

	$arq 	= $cat.'.xml';
	$xml 	= simplexml_load_file($arq);

	$file 	= file_get_contents($arq);
	$dom 	= new DOMDocument;
	$dom->loadXML($file);

	$elemento 	= $dom->getElementsByTagName('id');
	$atr 		= $elemento->item(0)->getAttribute('n');
	echo $atr;
	echo $codigo;
} //fecha 2º if

?>