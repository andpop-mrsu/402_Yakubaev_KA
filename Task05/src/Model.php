<?php

    namespace kyya\cold_hot\Model;

    use RedBeanPHP\R as R;

    R::setup("sqlite:coldhotDB.db");
	
    function insertSymbol($count, $sym = " ")
	{
		$str = "";
		for($i = 0; $i < $count; $i++) { 
			$str .= $sym; 
		}
		return $str;
	}

    function getId()
    {  
        $db = R::getRow("select id from games order by id desc limit 1");
        return $db['id']; 
    }

	function insertIntoDB($currentNumber)
	{  
		date_default_timezone_set("Europe/Moscow");
		$gameData = date("d").".".date("m").".".date("Y");
		$gameTime = date("H").":".date("i").":".date("s");
		$userName = getenv("username");

        $db = R::dispense('games');
        $db->gameDate = $gameData;
        $db->gameTime = $gameTime;
        $db->userName = $userName;
        $db->gameNumber = $currentNumber;
        $db->gameResult = "Not complete";
        R::store($db);
	}
	
	function updateDB($id, $result)
	{
        $db = R::load('games', $id);
        $db->gameResult = $result;
        R::store($db);
	}
		
	function showReplay($id)
	{
		$db = R::getAll("select * from info where game_id =".$id); //
		if (sizeof($db) != 0) {
			\cli\line("Repeat game with id = ".$id);
			foreach ($db as $row) {
				\cli\line($row["game_result"]);
			}
		} else {
			\cli\line("BD is empty");
		}
	}
	
	function insertReplay($id, $attemptResult)
	{
        $db = R::dispense('info');
        $db->gameID = $id;
        $db->gameResult = $attemptResult;
        R::store($db);
	}
	
	function showList()
	{
        $db = R::getAll('select * from games');
        if (sizeof($db) !== 0) {
            $row = $db[0];

            \cli\line(" ID ".insertSymbol(strlen($row["id"])).
			" | Date ".insertSymbol(strlen($row["game_date"])).
			" | Time ".insertSymbol(strlen($row["game_time"])).
			" | UserName ".insertSymbol(20).
			" | Number ".insertSymbol(strlen($row["game_number"])).
			" | Result ".insertSymbol(strlen($row["game_result"])));
			
			\cli\line("-".insertSymbol(strlen($row["id"]) + 3, "-").
			"-+-".insertSymbol(strlen($row["game_date"]) + 5, "-").
			"-+-".insertSymbol(strlen($row["game_time"]) + 5,"-").
			"-+-".insertSymbol(20 + 9, "-").
			"-+-".insertSymbol(strlen($row["game_number"]) + 7,"-").
			"-+-".insertSymbol(strlen($row["game_result"]) + 7,"-"));
            foreach ($db as $row) {
                \cli\line(" ".$row["id"].insertSymbol(3).
				" | ".$row["game_date"].insertSymbol(5).
				" | ".$row["game_time"].insertSymbol(5).
				" | ".$row["user_name"].
                insertSymbol(20 - strlen($row["user_name"]) + 9).
				" | ".$row["game_number"].insertSymbol(7).
				" | ".$row["game_result"].insertSymbol(7));
            }

        } else {
			\cli\line("BD is empty");
		}
	}