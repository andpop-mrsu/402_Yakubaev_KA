import {
    listGamesDB,
    replayGameDB,
    replayField,
    messageField
} from "./Model.js";

export function showGame() {
    document.getElementById("login").style.display = "none";
    document.getElementById("main").style.display = "block";
    document.getElementById("guessNumber").value = "";
    messageField.innerHTML = "Результат попытки";
}

export function showMessage(text) {
    messageField.innerHTML = text;
}

export async function showAllGames() {
    let html = await listGamesDB();
    replayField.innerHTML = html;
}

export async function replayGame(id_game) {
    let html = await replayGameDB(id_game);
    replayField.innerHTML = html;
}

export async function disableButton() {
    document.getElementById("turn-button").disabled = true;
}

export async function activeButton() {
    document.getElementById("turn-button").disabled = false;
}
