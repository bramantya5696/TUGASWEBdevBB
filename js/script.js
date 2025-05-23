let playerName = "";

function startNewGame() {
  document.getElementById("newGame").style.display = "none";
  document.getElementById("nameInputDiv").style.display = "block";
  document.getElementById("gameDiv").style.display = "none";
  document.getElementById("afterGameDiv").style.display = "none";
  document.getElementById("result").textContent = "";
  document.getElementById("playerName").value = "";
}

function submitName() {
  const name = document.getElementById("playerName").value.trim();
  if (name === "") {
    alert("Please enter your name.");
    return;
  }
  playerName = name;
  document.getElementById("nameInputDiv").style.display = "none";
  document.getElementById("gameDiv").style.display = "block";
  document.querySelector("#gameDiv .game-button").style.display = "block";
  document.getElementById(
    "greeting"
  ).textContent = `Hello, ${playerName}! Choose your move:`;
  document.getElementById("result").textContent = "";
}

function play(userChoice) {
  const choices = ["rock", "paper", "scissors"];
  const computerChoice = choices[Math.floor(Math.random() * 3)];
  let result = "";
  let shortResult = "";

  switch (userChoice) {
    case "rock":
      document.querySelector("#playerHand i.fa-hand").style.display = "none";
      document.querySelector("#playerHand i.fa-hand-back-fist").style.display =
        "inline";
      document.querySelector("#playerHand i.fa-hand-scissors").style.display =
        "none";
      break;
    case "paper":
      document.querySelector("#playerHand i.fa-hand").style.display = "inline";
      document.querySelector("#playerHand i.fa-hand-back-fist").style.display =
        "none";
      document.querySelector("#playerHand i.fa-hand-scissors").style.display =
        "none";
      break;
    case "scissors":
      document.querySelector("#playerHand i.fa-hand").style.display = "none";
      document.querySelector("#playerHand i.fa-hand-back-fist").style.display =
        "none";
      document.querySelector("#playerHand i.fa-hand-scissors").style.display =
        "inline";
      break;
    default:
      alert("Invalid choice!");
      return;
  }
  switch (computerChoice) {
    case "rock":
      document.querySelector("#compHand i.fa-hand").style.display = "none";
      document.querySelector("#compHand i.fa-hand-back-fist").style.display =
        "inline";
      document.querySelector("#compHand i.fa-hand-scissors").style.display =
        "none";
      break;
    case "paper":
      document.querySelector("#compHand i.fa-hand").style.display = "inline";
      document.querySelector("#compHand i.fa-hand-back-fist").style.display =
        "none";
      document.querySelector("#compHand i.fa-hand-scissors").style.display =
        "none";
      break;
    case "scissors":
      document.querySelector("#compHand i.fa-hand").style.display = "none";
      document.querySelector("#compHand i.fa-hand-back-fist").style.display =
        "none";
      document.querySelector("#compHand i.fa-hand-scissors").style.display =
        "inline";
      break;
    default:
      alert("Invalid choice!");
      return;
  }

  if (userChoice === computerChoice) {
    result = `Draw! Both chose ${userChoice}.`;
    shortResult = "draw";
  } else if (
    (userChoice === "rock" && computerChoice === "scissors") ||
    (userChoice === "paper" && computerChoice === "rock") ||
    (userChoice === "scissors" && computerChoice === "paper")
  ) {
    result = `You win, ${playerName}! ${userChoice} beats ${computerChoice}.`;
    shortResult = "win";
  } else {
    result = `You lose, ${playerName}! ${computerChoice} beats ${userChoice}.`;
    shortResult = "lose";
  }

  saveGameResult(playerName, userChoice, computerChoice, shortResult);

  document.querySelector("#gameDiv .game-button").style.display = "none";
  document.getElementById("result").textContent = result;
  document.getElementById("afterGameDiv").style.display = "block";
  // document.getElementById("gameDiv").style.display = "none";
}

function playAgain() {
  document.querySelector("#gameDiv .game-button").style.display = "block";
  document.getElementById("gameDiv").style.display = "block";
  document.getElementById("afterGameDiv").style.display = "none";
  document.getElementById("result").textContent = "";
}

function saveGameResult(playerName, userChoice, computerChoice, shortResult) {
  fetch("save_game.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `name=${encodeURIComponent(
      playerName
    )}&player_move=${encodeURIComponent(
      userChoice
    )}&comp_move=${encodeURIComponent(
      computerChoice
    )}&result=${encodeURIComponent(shortResult)}`,
  })
    .then((response) => response.json())
    .then((data) => {
      if (!data.success) {
        alert("Failed to save game: " + (data.error || "Unknown error"));
      }
    });
}
