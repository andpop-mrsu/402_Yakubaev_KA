<?php
	namespace kyya\cold_hot\View;
	
	function showGame()
	{
		echo 'Игра началась.' . PHP_EOL;
	}
	
	function help()
	{
		echo '+----------------------------------------------------------------+
	|                        Помощь по игре                          |
	+----------------------------------------------------------------+
	| "Cold". Ни одна цифра не отгадана.                             |
	| "Warm" Одна цифра отгадана, но не отгадана ее позиция.         |
	| "Hot". Одна цифра и ее позиция отгадана.                       |
	| Необходимо писать трехзначное число без запятых между цифрами. |
	+----------------------------------------------------------------+
	|                             Ключи                              |
	+----------------------------------------------------------------+
	| --new - Новая игра                                             |
	| --list - Список игр                                            |
	| --replay - Повтор игры                                         |
	| --help - Помощь                                                |
	+----------------------------------------------------------------+' . PHP_EOL;
	}
