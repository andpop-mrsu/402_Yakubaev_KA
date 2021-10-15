<?php
	namespace kyya\cold_hot\Controller;
	
	use SQLite3;
	use function kyya\cold_hot\View\showGame;
	use function kyya\cold_hot\View\help;
	
	
	function key($key, $id)
	{
		switch ($key)
		{
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
		for ($i = 0; $i < 3; $i++) 
		{
			if ($numberArray[$i] == $currentNumber[$i]) 
			{
				array_push($arr, "Hot");
			} 
			elseif ($numberArray[$i] == $currentNumber[0] || $numberArray[$i] == $currentNumber[1] || $numberArray[$i] == $currentNumber[2]) 
			{
				array_push($arr, "Warm");
			} 
			else 
			{
				array_push($arr, "Cold");
			}
		}
		sort($arr);
		return $arr;
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
		$currentNumber = array(random_int(0, 9));
		do{
			$new_num = random_int(0, 9);
			if(!in_array($new_num, $currentNumber))
			{
				array_push($currentNumber, $new_num);
			}			
		}while(count($currentNumber) < 3);   
		$number =  implode("", $currentNumber);
		$db = insertIntoDB($number);
		$attempt = 0;
		
		$id = $db->querySingle("SELECT gameId FROM games ORDER BY gameId DESC LIMIT 1");
		
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
						$result = "Win";         
						$attempt++;
						$attemptRes = coldhot($numberArray, $currentNumber);
						$attemptResult = $attempt." | ".$number." | ".implode(' ',$attemptRes);
						updateDB($id, $result);
						insertReplay($id, $attemptResult);
						restart();
					} 
					else 
					{
						$attempt++;
						$attemptRes = coldhot($numberArray, $currentNumber);
						foreach ($attemptRes as $row) 
						{
							echo $row . "\n";
						}
						$attemptRes = implode(" ", $attemptRes);
						$attemptResult = $attempt." | ".$number." | ".$attemptRes;
						insertReplay($id, $attemptResult);
					}
				}
			} 
			else 
			{
				echo "Ошибка! Введите число.\n";
			}
		}
	}
	
	function insertSymbol($count, $sym = " ")
	{
		$str = "";
		for($i = 0; $i < $count; $i++)
		{ 
			$str .= $sym; 
		}
		return $str;
	}
	
	function createDB()
	{
		$db = new SQLite3("coldhotDB.db");
	
		$game = "create table games(
			gameId integer primary key,
			gameDate date,
			gameTime time,
			userName text,
			gameNumber integer,
			gameResult text
		)";
		$db->exec($game);
	
		$attempts = "create table info(
			gameId integer,
			gameResult text
		)";
		$db->exec($attempts);
	
		return $db;
	}
	
	function openDB()
	{
		if (!file_exists("coldhotDB.db")) 
		{
			$db = createDB();
		} 
		else 
		{
			$db = new SQLite3("coldhotDB.db");
		}
		return $db;
	}
	
	function insertIntoDB($currentNumber)
	{
		$db = openDB();
	
		date_default_timezone_set("Europe/Moscow");
		$gameData = date("d").".".date("m").".".date("Y");
		$gameTime = date("H").":".date("i").":".date("s");
		$userName = getenv("username");
	
		$db->exec("insert into games (
			gameDate, 
			gameTime,
			userName,
			gameNumber,
			gameResult
			) values (
			'".$gameData."', 
			'".$gameTime."',
			'".$userName."',
			'".$currentNumber."',
			'Not complete'
			)");
	
		return $db;
	}
	
	function updateDB($id, $result)
	{
		$db = openDB();
		$db -> exec("update games
			set gameResult = '".$result."'
			where gameId = ".$id);
	}
		
	function showReplay($id)
	{
		$db = openDB();
		$query = $db->query("select count(*) from info where gameID = ".$id);
		if (($query->fetchArray()) != 0) 
		{
			\cli\line("Repeat game with id = ".$id);
			$query = $db->query("select gameResult from info where gameID = ".$id);
			while ($row = $query->fetchArray()) 
			{
				\cli\line($row[0]);
			}
		} 
		else 
		{
			\cli\line("BD is empty");
		}
	}
	
	function insertReplay($id, $attemptResult)
	{
		$db = openDB();
		$db -> exec("insert into info (
		gameID,
		gameResult
		) values (
		".$id.",
		'".$attemptResult."'
		)");
	}
	
	function showList()
	{
		$db = openDB();
		$query = $db->query('select count(*) from games');	
		if (($query->fetchArray()) != 0) 
		{
			$query = $db->query('select * from games');
			$row = $query->fetchArray();
			\cli\line(" ID ".insertSymbol(strlen($row[0])).
			" | Date ".insertSymbol(strlen($row[1])).
			" | Time ".insertSymbol(strlen($row[2])).
			" | UserName ".insertSymbol(20).
			" | Number ".insertSymbol(strlen($row[4])).
			" | Result ".insertSymbol(strlen($row[5])));
			
			\cli\line("-".insertSymbol(strlen($row[0]) + 3, "-").
			"-+-".insertSymbol(strlen($row[1]) + 5, "-").
			"-+-".insertSymbol(strlen($row[2]) + 5,"-").
			"-+-".insertSymbol(20 + 9, "-").
			"-+-".insertSymbol(strlen($row[4]) + 7,"-").
			"-+-".insertSymbol(strlen($row[5]) + 7,"-"));
			do
			{
				\cli\line(" ".$row[0].insertSymbol(3).
				" | ".$row[1].insertSymbol(5).
				" | ".$row[2].insertSymbol(5).
				" | ".$row[3].insertSymbol(20 - strlen($row[3]) + 9).
				" | ".$row[4].insertSymbol(7).
				" | ".$row[5].insertSymbol(7));
			}
			while ($row = $query->fetchArray()); 
		} 
		else 
		{
			\cli\line("BD is empty");
		}
	}