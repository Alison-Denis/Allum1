<?php
/*
$matches équivaut au nombre d'allumettes en jeu.
Si $turn vaut TRUE le joueur commence la partie, si elle vaut FALSE, l'IA commencera.
*/

// Initialisation
$matches = 11;
$turn = TRUE;

function game() {
    readline("./ allum1 \n");
    global $turn;
    global $matches;

    // START
    // Tant qu'il y a des allumettes, on joue :
    while ($matches > 0) {

        if ($turn == TRUE) {
            turnPlayer();
            $winner = "The AI";
        } else {
            turnAi();
            $winner = "Human player";
        }
    }
    echo "\nAnd the winner is ... $winner ! GG :) \n";
}

    function turnPlayer() {
        global $matches;
        global $turn;

        // Affichage des allumettes (de départ & restantes à chaque début de tour)
        $x = 1;
            while ($x <= $matches) {
                $x++;
                echo "|";
            }
        
        echo "\nYour turn :\nHow many match(es) do you want to remove ?\n";

        $choice = readline("\n");

            if ($choice > 0 && $choice < 4 && $choice <= $matches) { 
                // Si le nombre entré est bien compris entre 1 et 3    &&
                // $choice est obligatoirement inférieur ou égal au nombre d'allumettes restantes.
                echo "Player removed $choice match(es).\n";
                
                // $matches est ôté de 1 à 3 allumettes selon le $choice
                $matches = $matches - $choice;
                // init tour de l'ordi
                $turn = FALSE;

            // Sinon gestion des erreurs
            } elseif ($choice > $matches) {
                echo "Error: There is not enough matches...\nRemaining matches :\n";
            } else {
                echo "Error: invalid input (a number between 1 and 3 expected)\nRemaining matches : \n";
            }
    }

    function turnAi() {
        global $matches;
        global $turn;
        // init pour while
        $choice = 12;

        // Affichage allumettes
        $x = 1;
            while ($x <= $matches) {
                $x++;
                echo "|";
            }

        echo "\nAI's turn ...\n";

            if ($matches == 3) {
                // S'il reste que 3 allumettes, l'IA doit choisir 1 ou 2
                $choice = rand(1, 2);

            } elseif ($matches == 2) {
                // S'il reste 2, l'IA doit choisir 1 pour ne pas perdre
                $choice = 1;
                
            } else {
                // Sinon il choisit un nb random entre 1 et 3, mais
                // tant que le choix est supérieur aux allumettes restantes, il recommence
                while ($choice > $matches) {
                $choice = rand(1, 3);
                }
            }

        echo 'The AI removed '. $choice ." matche(s).\n";

        // $matches est ôté de 1 à 3 allumettes selon le $choice
        $matches = $matches - $choice;
        // Puis on passe au tour du joueur
        $turn = TRUE;
    }


game(); // Let's go !