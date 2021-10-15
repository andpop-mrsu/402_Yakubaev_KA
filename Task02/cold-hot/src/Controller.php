<?php
    namespace kyya\cold_hot\Controller;
    use function kyya\cold_hot\View\showGame;

    function startGame(){
        echo "Game started".PHP_EOL;
        showGame();
    }
?>
