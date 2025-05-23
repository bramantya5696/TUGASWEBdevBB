<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jankenpon</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="js/script.js"></script>
    <script src="https://kit.fontawesome.com/14ed735c0a.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- display new game section -->
    <section id="newGame">
        <h1>Jankenpon (Rock-Paper-Scissors)</h1>
        <button id="newGameBtn" onclick="startNewGame()">New Game</button>
    </section>

    <!-- fill name modal -->
    <div id="nameInputDiv" style="display:none;">
        <!-- <div id="nameInputDiv"> -->
        <label for="playerName">Enter your name : </label>
        <input type="text" id="playerName">
        <button onclick="submitName()">Start</button>
    </div>

    <!-- game section -->
    <section id="gameDiv" style="display: none;">
        <!-- <div id="gameDiv"> -->
        <h1 id="greeting">hello</h1>
        <div class="game-disp">
            <div class="main-game-hand">
                <div class="hand" id="playerHand">
                    <i class="fa-solid fa-hand" style="display: none;"></i>
                    <i class="fa-solid fa-hand-back-fist"></i>
                    <i class="fa-solid fa-hand-scissors" style="display: none;"></i>
                    <h3>Player</h3>
                </div>
                <h1>VS</h1>
                <div class="hand" id="compHand">
                    <i class="fa-solid fa-hand" style="display: none;"></i>
                    <i class="fa-solid fa-hand-back-fist"></i>
                    <i class="fa-solid fa-hand-scissors" style="display: none;"></i>
                    <h3>Comp</h3>
                </div>
            </div>
        </div>
        <div class="game-button">
            <button onclick="play('rock')">Rock</button>
            <button onclick="play('paper')">Paper</button>
            <button onclick="play('scissors')">Scissors</button>
        </div>
    </section>

    <!-- game result div -->
    <div id="afterGameDiv" style="display:none;">
        <p id="result"></p>
        <!-- <div id="afterGameDiv"> -->
        <button onclick="playAgain()">Try Again</button>
        <button onclick="startNewGame()">New Game</button>
    </div>

    <!-- game history section -->
    <div class="gameHistory">
        <h2>Game History</h2>
        <table>
            <thead>
                <tr>
                    <th>Game #</th>
                    <th>Name</th>
                    <th>Move</th>
                    <th>Move(Comp)</th>
                    <th>Result</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody id="gameHistory">
                <!-- Game history will be populated here -->
                <?php
                include 'db/db.php';
                $sql = "SELECT * FROM game_history ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                $gameNumber = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $gameNumber++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['player_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['move']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['move_comp']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['result']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
                <!-- <tr>
                    <td>1</td>
                    <td>Bram</td>
                    <td>scissors</td>
                    <td>scissors</td>
                    <td>draw</td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Bram</td>
                    <td>rock</td>
                    <td>scissors</td>
                    <td>win</td>
                    <td></td>
                </tr> -->
            </tbody>
        </table>
    </div>
</body>

</html>