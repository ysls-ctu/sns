// Declare userData at the beginning of your script
var userData;

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

function validateLogin() {
    console.log('validateLogin function called');

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    console.log('Username:', username);
    console.log('Password:', password);

    if (username && password) {
        // Send AJAX request to check login credentials
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/login.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response); // Log the response to the console for debugging

                // If login is successful, set userData
                if (response.status === 'success') {
                    console.log('Login successful. Displaying terms modal.');
                    document.getElementById("termsModal").style.display = "flex";
                    userData = response.userData;
                } else {
                    // Display an alert for error messages
                    alert(response.message);
                }
            }
        };

        var data = 'username=' + username + '&password=' + password;
        xhr.send(data);
    } else {
        // Display an alert if username or password is empty
        alert('Please enter both username and password.');
    }
}

function acceptTerms() {
    // Perform any additional actions if needed
    // Redirect to shopNswap-home.php with user information
    window.location.href = 'shopNswap-home.php?userID=' + userData.USER_ID + '&userFName=' + userData.USER_FNAME + '&userLName=' + userData.USER_LNAME;
}

function nevermind() {
    // Perform any additional actions if needed
    // Redirect to login page
    window.location.href = 'shopNswap-login.php';
}