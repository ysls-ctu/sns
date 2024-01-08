// Wrap your existing code inside a DOMContentLoaded event listener
document.addEventListener('DOMContentLoaded', function () {
    function createAccount(event) {
        event.preventDefault();

        var signupUsername = document.getElementById('signupUsername').value;
        var signupPassword = document.getElementById('signupPassword').value;
        var confirmEmail = document.getElementById('confirmEmail').value;
        var confirmPassword = document.getElementById('confirmPassword').value;

        if (signupUsername && signupPassword && confirmEmail && confirmPassword) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/register.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status == 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);

                        if (response.status === 'success') {
                            alert('Account created successfully!');
                            window.location.href = 'shopNswap-login.php';
                        } else {
                            alert(response.message || 'Account creation failed.');
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                    }
                } else {
                    console.error('Error:', xhr.statusText);
                }
            };

            xhr.send('signupUsername=' + signupUsername + '&signupPassword=' + signupPassword + '&confirmEmail=' + confirmEmail + '&confirmPassword=' + confirmPassword);
        } else {
            alert('Please fill in all required fields.');
            console.log('Validation error. Account creation not attempted.');
        }
    }

    // Attach the event listener to the form
    document.getElementById('createAccount').addEventListener('submit', createAccount);
});
