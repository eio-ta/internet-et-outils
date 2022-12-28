<?php
	$tab = array("a" => "Français", "b" => "Physique", "c" => "Anglais", "d" => "Histoire", "e" => "Chimie");
	
	function generer_checkbox($tab){
		foreach($tab as $index => $val){
			echo $val, "<input type=\"checkbox\" name = \"cours[]\" value =", $val, "<br><br>";
		}
	}
	
	generer_checkbox($tab);

?>