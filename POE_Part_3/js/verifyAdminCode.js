document.getElementById("confirmationCode").addEventListener("submit", function(e) {
    e.preventDefault(); // Prevent the default form submission behavior

    var code = document.getElementById('codeInput').value;

    if (code === 'adminPriv') {
        alert('Code verified! Redirecting to dashboard...');
        document.getElementById('confirmationCode').style.display = 'none'; // hide popup
        window.location.href = 'dashboard.php'; // proceed to admin login
    } else {
        alert('Warning: Incorrect code. Access denied.');
        window.location.href = 'login.php'; // bounce back to regular login
    }
});

