//sign in functions
// objPeople contains pre-made accounts
var objPeople = [
    {
        username: "ysl",
        password: "admin123",
    },
    {
        username: "ice",
        password: "ice123",
    },
    {
        username: "123",
        password: "acc123",
    }
]

//Check if the userinput is the same with the accounts
function validate() {
    var username = document.getElementById("username").value
    var password = document.getElementById("password").value
    // for loop to check the user and pass by indexes of objpeople
    for (i = 0; i < objPeople.length; i++) {
        if (username == objPeople[i].username && password == objPeople[i].password) {
            alert(username + " has logged in successfully!");
            window.location.href = "shopNswap-home.html";
            return

        }
    }
    alert("Incorrect Username or Password")
}

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");
    const createAccountForm = document.querySelector("#createAccount");

    document.querySelector("#linkCreateAccount").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.remove("form--hidden");
    });

    document.querySelector("#linkLogin").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        createAccountForm.classList.add("form--hidden");
    });

    loginForm.addEventListener("submit", e => {
        e.preventDefault();

        // Perform your AJAX/Fetch login

        setFormMessage(loginForm, "error", "Invalid username/password combination");
    });

    document.querySelectorAll(".form__input").forEach(inputElement => {
        inputElement.addEventListener("blur", e => {
            if (e.target.id === "signupUsername" && e.target.value.length > 0 && e.target.value.length < 10) {
                setInputError(inputElement, "Username must be at least 10 characters in length");
            }
        });

        inputElement.addEventListener("input", e => {
            clearInputError(inputElement);
        });
    });
});