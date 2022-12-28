<?php
$alphabet = "abcdefghijklmnopqrstuvwxyz";
function contient($lettre, $alphabet){
    for($i=0; $i<26; $i++){
        if($lettre == substr($alphabet, $i, 1)){
            return true;
        }
    }
    return false;
}
?>