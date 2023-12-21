<?php

define('LENGTH',10);
function get_pass() {
	
	$str = "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
	
	$str_lenght = strlen($str) - 1;

	$str_gen = ''; //переменная, в которую будет сохранён пароль
	
	for($i = 0; $i < LENGTH; $i++) { //генерация нового пароля
		
		$x = mt_rand(0,$str_lenght);
		
		$str_gen .= $str[$x];
	}
	
	return $str_gen;
}

?>