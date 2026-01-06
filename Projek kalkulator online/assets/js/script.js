let currentInput = "0";
const display = document.getElementById('current-display');
const dropdownMenu = document.getElementById('dropdownMenu');
const menuBtn = document.getElementById('menuBtn');

function updateDisplay() {
    display.innerText = currentInput;
}

// Aktifkan klik menu titik tiga
if (menuBtn) {
    menuBtn.onclick = (e) => {
        e.stopPropagation();
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    };
}

function toggleTheme() {
    document.body.classList.toggle('light-mode');
    dropdownMenu.style.display = 'none';
}

function appendNumber(num) {
    // Menghapus '0' default jika angka baru dimasukkan
    if (currentInput === "0" && num !== ".") {
        currentInput = num;
    } else {
        currentInput += num;
    }
    updateDisplay();
}

function appendOperator(op) {
    // Jika layar masih "0", dan yang ditekan adalah kurung buka '(', langsung ganti 0-nya
    if (currentInput === "0" && op === "(") {
        currentInput = op;
    } else {
        // Cek agar tidak ada operator ganda berturut-turut (kecuali kurung)
        const lastChar = currentInput.slice(-1);
        const operators = ["+", "-", "*", "/", "×", "÷"];
        
        if (operators.includes(lastChar) && operators.includes(op)) {
            return; // Jangan tambahkan jika operator dobel
        }
        
        currentInput += op;
    }
    updateDisplay();
}

function clearDisplay() {
    currentInput = "0";
    updateDisplay();
}

async function calculate() {
    try {
        let expression = currentInput.replace(/×/g, '*').replace(/÷/g, '/');
        let result = eval(expression);
        let historyExp = currentInput;

        currentInput = result.toString();
        updateDisplay();

        // Simpan ke database
        fetch('process.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `operation=${encodeURIComponent(historyExp)}&result=${result}`
        });
    } catch (e) {
        currentInput = "Error";
        updateDisplay();
        setTimeout(clearDisplay, 1500);
    }
}

async function toggleHistory() {
    const modal = document.getElementById('historyModal');
    const list = document.getElementById('historyList');
    modal.style.display = 'block';
    dropdownMenu.style.display = 'none';
    list.innerHTML = "Memuat...";

    try {
        const res = await fetch('actions/get_history.php');
        const data = await res.json();
        list.innerHTML = data.length === 0 ? "Tidak ada riwayat." : 
            data.map(h => `<div style="padding:10px 0; border-bottom:1px solid #444;">
                <small>${h.created_at}</small><br>${h.operation} = <b>${h.result}</b>
            </div>`).join('');
    } catch (e) {
        list.innerHTML = "Gagal memuat histori.";
    }
}

function closeHistory() {
    document.getElementById('historyModal').style.display = 'none';
}

window.onclick = (e) => {
    if (!e.target.matches('#menuBtn')) dropdownMenu.style.display = 'none';
    if (e.target.id === 'historyModal') closeHistory();
};