<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Pro iPhone Style</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dark-mode">

    <div class="calculator-container">
        <div class="menu-container">
            <i class="fas fa-ellipsis-v" id="menuBtn"></i>
            <div class="dropdown-menu" id="dropdownMenu">
                <ul>
                    <li onclick="toggleHistory()"><i class="fas fa-history"></i> Histori</li>
                    <li onclick="toggleTheme()"><i class="fas fa-adjust"></i> Ganti Tema</li>
                </ul>
            </div>
        </div>

        <div class="display">
            <div id="current-display">0</div>
        </div>

        <div class="buttons">
            <button class="btn btn-gray" onclick="clearDisplay()">AC</button>
            <button class="btn btn-gray" onclick="appendOperator('(')">(</button>
            <button class="btn btn-gray" onclick="appendOperator(')')">)</button>
            <button class="btn btn-orange" onclick="appendOperator('÷')">÷</button>

            <button class="btn" onclick="appendNumber('7')">7</button>
            <button class="btn" onclick="appendNumber('8')">8</button>
            <button class="btn" onclick="appendNumber('9')">9</button>
            <button class="btn btn-orange" onclick="appendOperator('×')">×</button>

            <button class="btn" onclick="appendNumber('4')">4</button>
            <button class="btn" onclick="appendNumber('5')">5</button>
            <button class="btn" onclick="appendNumber('6')">6</button>
            <button class="btn btn-orange" onclick="appendOperator('-')">−</button>

            <button class="btn" onclick="appendNumber('1')">1</button>
            <button class="btn" onclick="appendNumber('2')">2</button>
            <button class="btn" onclick="appendNumber('3')">3</button>
            <button class="btn btn-orange" onclick="appendOperator('+')">+</button>

            <button class="btn btn-zero" onclick="appendNumber('0')">0</button>
            <button class="btn" onclick="appendNumber('.')">.</button>
            <button class="btn btn-orange" onclick="calculate()">=</button>
        </div>
    </div>

    <div id="historyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeHistory()">&times;</span>
            <h3>Riwayat Perhitungan</h3>
            <hr style="border: 0.5px solid rgba(128,128,128,0.3);">
            <div id="historyList">
                </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>