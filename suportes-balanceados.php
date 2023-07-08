<?php

function trataColchetes(string $brackets): bool
{
    if (strlen($brackets) % 2 !== 0) {
        echo "Coleção inválida \n";
        return false;
    }
    
    do {
        $lastLength = strlen($brackets);
        echo $brackets . " - \n";
        $brackets = str_replace(['[]', '{}', '()'], '', $brackets);
    } while($lastLength != strlen($brackets) && strlen($brackets) != 0);

    if (strlen($brackets) > 0) {
        echo "Coleção inválida \n";
        return false;
    }

    echo "Coleção válida \n";
    return true;
}

$colchetes = '()[]{}';
// $colchetes = '[{()}](){}';
// $colchetes = '[]{()';
// $colchetes = '[{)]';
trataColchetes($colchetes);