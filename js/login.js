document.getElementById('linkCreateAccount').addEventListener('click', function (event) {
    event.preventDefault(); 
    document.getElementById('login').classList.add('form--hidden');
    document.getElementById('createAccount').classList.remove('form--hidden');
});

document.getElementById('linkLogin').addEventListener('click', function (event) {
    event.preventDefault(); 
    document.getElementById('createAccount').classList.add('form--hidden');
    document.getElementById('login').classList.remove('form--hidden');
});

function acceptTerms() {
    // Redirect to shopNswap-home.php with user information
    window.location.href = 'shopNswap-home.php?userID=' + userData.userID + '&userFName=' + userData.userFName + '&userLName=' + userData.userLName;
}

function nevermind() {
    // Redirect back to shopNswap-login.php
    window.location.href = 'shopNswap-login.php';
}
