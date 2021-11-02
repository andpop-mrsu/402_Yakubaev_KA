<?php

	namespace kyya\cold_hot\Controller;

	use function kyya\cold_hot\Model\getId;
	use function kyya\cold_hot\Model\insertIntoDB;
	use function kyya\cold_hot\Model\updateDB;
	use function kyya\cold_hot\Model\showReplay;
	use function kyya\cold_hot\Model\insertReplay;
	use function kyya\cold_hot\Model\showList;

	use function kyya\cold_hot\View\showGame;
	use function kyya\cold_hot\View\help;
	
	function key($key, $id)
	{
		switch ($key) {
			case "--new":
				startGame();
				break;
			case "--list":
				showList();
				break;
			case "--replay":
				showReplay($id);
				break;
			case "--help":
				help();
				break;
			default:
				echo "Не верный ключ.\n";
		}
	}
	
	function coldhot($numberArray, $currentNumber)
	{
		$arr = array();
		for ($i = 0; $i < 3; $i++) {
			if ($numberArray[$i] == $currentNumber[$i]) {
				array_push($arr, "Hot");
			} 
			elseif (
				$numberArray[$i] == $currentNumber[0] || 
				$numberArray[$i] == $currentNumber[1] || 
				$numberArray[$i] == $currentNumber[2] 
			) {
				array_push($arr, "Warm");
			} else {
				array_push($arr, "Cold");
			}
		}
		sort($arr);
		return $arr;
	}
	
	function restart()
	{
		$restart = readline("Хотите сыграть ещё?[Y/N]\n");
		if ($restart == "Y" || $restart == "y") {
			startGame();
		} else {
			exit;
		}
	}
	
	function startGame()
	{
		showGame();
		$number = 0;
		$currentNumber = array(random_int(0, 9));
		do {
			$new_num = random_int(0, 9);
			if(!in_array($new_num, $currentNumber)) {
				array_push($currentNumber, $new_num);
			}			
		} while(count($currentNumber) < 3);   
		$number =  implode("", $currentNumber);
		insertIntoDB($number);
		$attempt = 0;

		$id = getId();

		while ($number != $currentNumber) 
		{
			$number = readline("Введите трехзначное число : ");
			if (is_numeric($number)) {
				if (strlen($number) != 3) {
					echo "Ошибка! Число должно быть трехзначным\n";
				} else {
					$numberArray = str_split($number);
					if ($numberArray == $currentNumber) {
						echo "Вы выиграли!\n";
						$result = "Win";         
						$attempt++;
						$attemptRes = coldhot($numberArray, $currentNumber);
						$attemptResult = $attempt." | ".$number.
						" | ".implode(' ',$attemptRes);
						updateDB($id, $result);
						insertReplay($id, $attemptResult);
						restart();
					} else {
						$attempt++;
						$attemptRes = coldhot($numberArray, $currentNumber);
						foreach ($attemptRes as $row) {
							echo $row . "\n";
						}
						$attemptRes = implode(" ", $attemptRes);
						$attemptResult = $attempt." | ".$number.
						" | ".$attemptRes;
						insertReplay($id, $attemptResult);
					}
				}
			} else {
				echo "Ошибка! Введите число.\n";
			}
		}
	}