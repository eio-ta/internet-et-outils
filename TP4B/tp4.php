<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="utf-8">
            <?php
            $tab1 = array (
				1 => " Bonjour " ,
				2 => " Ceci " ,
				3 => " est une " ,
				4 => " ComboBreaker " ,
				5 => " liste " );
				
		 function age($x){
			$a = explode("/", $x);
			$b = explode("/", date("d/m/Y"));
			if((int)$b[1]<(int)$a[1]){
				return $b[2]-$a[2]-1;
			}else{
				if($b[0]<$a[0]){
					return $b[2]-$a[2]-1;
				}
				return $b[2]-$a[2];
			}
		}
		
		function comparaison($x, $y){
			$a = explode("/", $x);
			$b = explode("/", $y);
			if($a[2] != $b[2]){
				if($a[2] < $b[2]){
					return 1;
				} else {
					return -1;
				}
			} else {
				if($a[1] != $b[1]){
					if($a[1] < $b[1]){
						return 1;
					} else {
						return -1;
					}
				} else {
					if($a[0] != $b[0]){
						if($a[0] < $b[0]){
							return 1;
						} else {
							return -1;
						}
					} else {
						return 0;
					}
				}
			}
		}
		
		function query($x, $y){
			$c=comparaison($x,$y);
			if($c==1 || $c==0){
				return $x;
			}else {
				return $y;
			}		
		}
		
		function tableau($tab){
				echo "<ol>";
				foreach ($tab as $index => $var){
					echo "<li>",$var,"</li>";
				}
				echo "</ol>";
		}
		
		$hello = array("patate", "choufleur", "aubergine");
		
		$patate = "eeeeee";
		
		$st1 = array("capitale" => "Amsterdam", "hab" => 2, "continent" => "Europe");
		$st2 = array("capitale" => "Amsterdam", "hab" => 2, "continent" => "Europe");
		$st3 = array("capitale" => "Berlin", "hab" => 4, "continent" => "Europe");
		$st4 = array("capitale" => "Ottawa", "hab" => 5, "continent" => "Amérique");
		$pays = array("Pays-Bas" => $st1, "Hollande"=> $st2, "Allemagne"=> $st3, "Canada"=> $st4);
		
		function findArray($tab, $cap, $val){
			$x=0;
			$res = array();
			foreach($tab as $index => $t){
				if($t[$cap] == $val){
					$res[$x] = $index;
					$x++;
				}
			}
			return $res;
		}
		
		function flatten($tab){
			$rep=array();
			foreach($tab as $index => $a){
				foreach($a as $index2 => $b){
					$rep[$index."/".$index2]=$b;
				}
			}
			return $rep;
		}
		
	
		
		function palindrome($st){
			$boo = true;
			$x = strlen($st);
			for($i=0; $i<$x/2; $i++){
				$a=substr($st, $i, 1);
				$b=$a.$b;
			}
			if(substr($a != $b)){
				$boo = false;
			}
			return $boo ? "true": "false";
		}
		
		function palindrome2($h){
			return palindrome($h);
		}
		
		$papa = array("hello", "comment", "ça va ?");
		
		function fusion($tab, $sep){
			foreach($tab as $index => $a){
				$rep = $rep.$sep.$a;
			}
			return substr($rep, 1);
		}
		
		function destruction($texte, $sep){
			$x=0;
			$a=0;
			$res=array();
			for($i=0;$i<strlen($texte);$i++){
				if(substr($texte,$i,strlen($sep))==$sep){
					$e=substr($texte,$a,$i-$a);
					$res[$x]=$e;
					$a=$i+strlen($sep);
					$x++;
				}
			}
			echo $a;
			$res[$x]=substr($texte,$a);
			return $res;
		}

		function array_table($tab){
			echo "<table border=1>
			<thead>
			<tr> <th> Clé </th> <th> Valeur </th> </tr>
			</thead>
			<tbody>";
	
			foreach($tab as $index => $val){
				echo "<tr> <td> ",$index, "</td> <td>", $val,"</td> </tr>";
			}
			echo "</tbody></table>"; 
		}
	
		$array = array("entrée"=> "<sortie","input"=> "output");

        ?>
            <title>haha</title>
        </head>
        <body>
            <?php
            echo age("11/04/2002"),"<br>";
            echo comparaison("11/04/2002", "06/05/2002"),"<br>";
            echo query(htmlspecialchars($_GET["date1"]), htmlspecialchars($_GET["date2"]));
            tableau($hello);
            tableau($tab1);
            echo substr_count($patate, e),"<br>";
            echo print_r(findArray($pays, "continent", "Europe")),"<br>";
            echo palindrome("2002"),"<br>";
            echo palindrome2(htmlspecialchars($_GET["pala"])),"<br>";
            echo print_r(flatten($pays)),"<br>";
            echo fusion($papa, " "),"<br>";
			print_r(destruction("un deux trois"," "));
			array_table($array); 
            ?>
        </body>
    </html> 
