<?php

require __DIR__ . '../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', 'index.html');

$app->get('/games', function ($request, $response) {
    $gameInfo = json_encode(listGames()); 
    $response->getBody()->write($gameInfo);
    return $response;
});

$app->get('/games/{id}', function ($request, $response, array $args) {
    $Gameid = $args['id'];
    $responseBody = json_encode(turnsById($Gameid));
    $response->getBody()->write($responseBody);
    return $response;
});

$app->post('/games', function ($request, $response) {
    $string = json_decode($request->getBody());
    $info = explode("|", $string);
    $gameInfo = explode("+", $info[1]);
    $turns = explode("+", $info[0]); 
    insertInfo($gameInfo, $turns);
    $response->write('Бд заполнена');
    return $response;
});

$app->run();

function openDatabase()
{
    if (!file_exists("./../db/gamedb.db")) {
        $db = new \SQLite3('./../db/gamedb.db');

        $gameInfoTable = "CREATE TABLE gameInfo(
            id INTEGER PRIMARY KEY,
            date DATE,
            username TEXT,
            secretNumber TEXT,
            result TEXT
        )";
        $db->exec($gameInfoTable);

        $attemptInfoTable = "CREATE TABLE attemptInfo(
            id INTEGER KEY,
            attempt INTEGER,
            currentNumber TEXT,
            result TEXT)";
        $db->exec($attemptInfoTable);
    } else {
        $db = new \SQLite3('./../db/gamedb.db');
    }
    return $db;
}

function getGameId($db)
{
    $query = "SELECT id 
    FROM gameInfo 
    ORDER BY id DESC LIMIT 1";
    $result = $db->querySingle($query);
    if (is_null($result))
        return 1;
    return $result + 1;
}

function insertInfo($gameInfo, $turns)
{
    $db = openDatabase();
    $id = getGameId($db);
    $date = $gameInfo[0];
    $username = $gameInfo[1];
    $secretNumber = $gameInfo[2];
    $result = $gameInfo[3];

    $attempt = $gameInfo[4];
    $currentNumber = $gameInfo[5];
    $attemptResult = $gameInfo[6];
    $db->exec("INSERT INTO gameInfo (
        id,
        date,
        username,
        secretNumber,
        result
    ) VALUES (
        '$id', 
        '$date', 
        '$username', 
        '$secretNumber',  
        '$result')"
    );
    
    for($i = 0; $i < count($attempt); $i++) {
        $db->exec("INSERT INTO attemptInfo (
            id, 
            attempt, 
            currentNumber,
            result
            ) VALUES (
            '$id', 
            '$attempt[$i]', 
            '$currentNumber[$i]',
            '$attemptResult[$i]')");
    }
}

function listGames()
{
    $db = openDatabase();
    $result = $db->query("SELECT * FROM gameInfo");
    $gameInfo = "";
    while ($row = $result->fetchArray()) {
        for ($i = 0; $i < 5; $i++) {
            $gameInfo .= $row[$i] . "|";
        }
        $gameInfo .= ";";
    }
    return $gameInfo;
}


function gameById($id)
{
    $db = openDatabase();
    $result = $db->query("SELECT * FROM gameInfo WHERE id = '$id'");
    $gameInfo = "";
    while ($row = $result->fetchArray()) {
        for ($i = 0; $i < 5; $i++) {
            $gameInfo .= $row[$i] . "|";
        }
        $gameInfo .= ";";
    }
}

function turnsById($id)
{
    $db = openDatabase();
    $result = $db->query("SELECT * FROM attemptInfo WHERE id = '$id'");
    $turnsInfo = "";
    while ($row = $result->fetchArray()) {
        for ($i = 0; $i < 4; $i++) {
            $turnsInfo .= $row[$i] . "|";
        }
        $turnsInfo .= ";";
    }
    return $turnsInfo;
}
