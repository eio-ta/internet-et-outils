<?php
    $tab = array("Style 1" => "style1.css", "Style 2" => "style2.css", "Style 3" => "style3.css");

    function generer_menu($tab){
        echo "<select name=\"style\" size=\"1\">";
		foreach($tab as $index => $val){
            echo "<option>", $val;
        }
        echo "</select>";
	}
	
	generer_menu($tab);
?>