let db;
export let replayField = document.getElementById("replay-field");
export let messageField = document.getElementById("messageField");

export async function createDB() {
    db = await idb.openDB("codlHotDB", 1, {upgrade(db) {
        db.createObjectStore('gameInfo', {keyPath: 'id', autoIncrement: true});
        db.createObjectStore('attemptInfo', {keyPath: 'id', autoIncrement: true});
    }
    }); 
}

export async function startDB(username, secretNumber, result) {
    db = await idb.openDB("codlHotDB", 1, { upgrade(db) {
        db.createObjectStore('gameInfo', {keyPath: 'id', autoIncrement: true});
        db.createObjectStore('attemptInfo', {keyPath: 'id', autoIncrement: true});
    }
    });

    await db.add('gameInfo', {
        date: new Date(),
        username,
        secretNumber,
        result
    });
}

export async function writeAttemptInfo(attempt, currentNumber, result) {
    let idGame = await db.getAll('gameInfo');
    await db.add('attemptInfo', {
        idGame: idGame.length,
        attempt,
        currentNumber,
        result
    });
}

export async function updateGameStatus(result) {
    let idGame = await db.getAll('gameInfo');
    let cursor = await db.transaction('gameInfo', 'readwrite').store.openCursor();

    while (cursor) {
        if (cursor.value.id == idGame.length) {
            let updateData = cursor.value;
            updateData.result = result;
            cursor.update(updateData);
        }

        cursor = await cursor.continue();
    }
}

export async function listGamesDB(){
    let games = await db.getAll('gameInfo');
    let html = "<tr>";
    html += "<th>ID</th>";
    html += "<th>Дата</th>";
    html += "<th>Имя игрока</th>";
    html += "<th>Число</th>";
    html += "<th>Результат</th>";
    html += "</tr>";
    
    if(games.length > 0){
        for(let i = 0; i < games.length; i++){
            html += "<tr>";
            html += "<th>" + games[i]['id'] + "</th>";
            let dateArr = (games[i]['date'] + '').split(' ');
            let date = dateArr[2] + ' ' + dateArr[1] + ' ' + dateArr[3] + ' ' + dateArr[4];
            html += "<th>" + date + "</th>";
            html += "<th>" + games[i]['username'] + "</th>";
            let secretNumber = (games[i]['secretNumber'] + '').split(',').join('');
            html += "<th>" + secretNumber + "</th>";
            html += "<th>" + games[i]['result'] + "</th>";
            html += "</tr>";
        }

        return  "<table>" + html + "</table>";
    }
    else{
        return "<table><tr><th>Данных нет</th></tr></table>";
    }
}

export async function replayGameDB(id_game){
    let cursor = await db.transaction('attemptInfo', 'readwrite').store.openCursor();

    let html = "<tr>";
    html += "<th>Попытка</th>";
    html += "<th>Число</th>";
    html += "<th>Результат</th>";
    html += "</tr>";

    let countAttemps = 0;

    while (cursor) {
        if (cursor.value.idGame == id_game) {
            let data = cursor.value;
            html += "<tr>";
            html += "<th>" + data.attempt + "</th>";
            let secretNumber = (data.currentNumber + '').split(',').join('');
            html += "<th>" + secretNumber + "</th>";
            html += "<th>" + data.result + "</th>";
            html += "</tr>";
            countAttemps++;
        }

        cursor = await cursor.continue();
    }

    if(countAttemps == 0){
        return "<table><tr><th>Попыток не было</th></tr></table>";
    }
    else{
        return "<table>" + html + "</table>";
    }
}

export function newSecretNumber(){
    let n = []
	n[0] = Math.floor(Math.random() * 10)
	do {
		let new_num = Math.floor(Math.random() * 10)
		if(n.indexOf(new_num) == -1) {
			n.push(new_num)
		}			
	} while(n.length < 3)

    console.log(n.join(""))
    return n
}