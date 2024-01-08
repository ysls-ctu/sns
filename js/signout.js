// sign out functions
function showPopup() {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
}

function hidePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
}

function overlayClick(event) {
    if (event.target.id === 'overlay') {
        hidePopup();
    }
}

function cancelSignOut() {
    hidePopup();
}

function confirmSignOut() {
    var userData = null; 
    window.location.href = 'shopNswap-login.php';
}