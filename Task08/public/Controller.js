import {
    showGame,
    showAllGames,
	replayGame,
	showMessage,
	disableButton,
	activeButton
} from "./View.js";

import {
    startDB,
    writeAttemptInfo,
    updateGameStatus,
	newSecretNumber,
} from "./Model.js";


document.getElementById("start").addEventListener("click", setName);
document.getElementById("turn-button").addEventListener("click", playGame);
document.getElementById("restart-game").addEventListener("click", restartGame);
document.getElementById("show-games").addEventListener("click", showAllGame);
document.getElementById("show-replay").addEventListener("click", showReplay);

let username;
let turns;
let secretNumber;
let gameMsg;
let currentNumber;

let number_field = document.getElementById("guessNumber");

function setName() {
    if (document.getElementById("name").value == "") {
        alert("Имя не может быть пустым");
    } else {
        username = document.getElementById("name").value;
        showGame();
        startGame();
    }
}

function startGame() {
	activeButton()
    turns = 0;
    secretNumber = newSecretNumber();
    startDB(username, secretNumber, "Не закончена");
}


function checkNumber(currentStrNumber, hiddenStrNumber) {
	let arr = []
	for (let i = 0; i < 3; i++) {
		if (currentStrNumber[i] == hiddenStrNumber[i]) {
			arr[i] = "Горячо"
		} else if (
			currentStrNumber[i] == hiddenStrNumber[0] ||
			currentStrNumber[i] == hiddenStrNumber[1] ||
			currentStrNumber[i] == hiddenStrNumber[2]
		) {
			arr[i] = "Тепло"
		} else {
			arr[i] = "Холодно"
		}
	}
	return arr
}


function playGame() {
	currentNumber = number_field.value
	let currentCheckNumber = Number(currentNumber)

	if (!Number.isInteger(currentCheckNumber)) {
		alert('Ошибка! Введите число.')
		return
	}

	if (currentNumber.length != 3) { 
		alert('Ошибка! Число должно быть трехзначным')
		return
	}

	turns++;
	currentNumber = currentNumber.split('')
	let currentStrNumber = currentNumber.toString()
	let hiddenStrNumber = secretNumber.toString()

	if (currentStrNumber == hiddenStrNumber && turns <= 10) {
		gameMsg = "Победа";
		writeAttemptInfo(turns, currentNumber, gameMsg)
		updateGameStatus(gameMsg)
		showMessage(gameMsg);
	} else if (turns < 10) {
		let arr = checkNumber(currentNumber, secretNumber)
		writeAttemptInfo(turns, currentNumber.join(""), arr.join(","))
		showMessage(arr.join(","));
	} else {
		gameMsg = "Поражение";
		writeAttemptInfo(turns, currentNumber, gameMsg)
		updateGameStatus(gameMsg)
		showMessage(gameMsg);
		disableButton();
	}
}

function restartGame() {
    showGame();
    startGame();
}

function showAllGame() {
    showAllGames();
}

function showReplay() {
    let id_game = parseInt(prompt("Введите id игры"))  
	if(isNaN(id_game)) {
		alert("Введите id игры!")
		return
	}
    replayGame(id_game);
}