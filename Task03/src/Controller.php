<?php

namespace kyya\cold_hot\Controller;

use function kyya\cold_hot\View\showGame;
use function kyya\cold_hot\View\showList;
use function kyya\cold_hot\View\showReplay;
use function kyya\cold_hot\View\help;

function key()
{
    switch (readline("Введите ключ: ")) 
    {
        case "--new":
            startGame();
            break;
        case "--list":
            showList();
            break;
        case "--replay":
            showReplay();
            break;
        case "--help":
            help();
            break;
        default:
            echo "Не верный ключ.\n";
            key();
    }
}

function coldhot($numberArray, $currentNumber)
{
    $arr = array();
    for ($i = 0; $i < 3; $i++) 
    {
        if ($numberArray[$i] == $currentNumber[$i]) 
        {
            array_push($arr, "Горячо!\n");
        } 
        elseif ($numberArray[$i] == $currentNumber[0] || $numberArray[$i] == $currentNumber[1] || $numberArray[$i] == $currentNumber[2]) 
        {
            array_push($arr, "Тепло!\n");
        } 
        else 
        {
            array_push($arr, "Холодно!\n");
        }
    }
    sort($arr);
    for ($i = 0; $i < 3; $i++) 
    {
        echo $arr[$i];
    }
}

function restart()
{
    $restart = readline("Хотите сыграть ещё?[Y/N]\n");
    if ($restart == "Y" || $restart == "y") 
    {
        startGame();
    } 
    else 
    {
        exit;
    }
}

function startGame()
{
    showGame();
    $number = 0;
    $currentNumber = random_int(100, 999);
    $currentNumber = str_split($currentNumber);
    while ($number != $currentNumber) 
    {
        $number = readline("Введите трехзначное число : ");
        if (is_numeric($number)) 
        {
            if (strlen($number) != 3) 
            {
                echo "Ошибка! Число должно быть трехзначным\n";
            } 
            else 
            {
                $numberArray = str_split($number);
                if ($numberArray == $currentNumber) 
                {
                    echo "Вы выиграли!\n";
                    restart();
                } 
                else 
                {
                    coldhot($numberArray, $currentNumber);
                }
            }
        } 
        else 
        {
            echo "Ошибка! Введите число.\n";
        }
    }
}