//redirect to link
function redirectTo(link) {
    window.location.href = link;
}

// // tag addition
// document.addEventListener('DOMContentLoaded', function () {
//     const tagInput = document.getElementById('tagInput');
//     let tagListContainer = document.getElementById('tagList');

//     // Check if tagListContainer is null and create the element if needed
//     if (!tagListContainer) {
//         tagListContainer = document.createElement('div');
//         tagListContainer.id = 'tagList';
//         document.body.appendChild(tagListContainer);
//     }

//     tagInput.addEventListener('keyup', function (event) {
//         if (event.key === 'Enter' && tagInput.value.trim() !== '') {
//             addTag(tagInput.value.trim());
//             tagInput.value = '';
//         }
//     });

//     function addTag(tagText) {
//         const tag = document.createElement('div');
//         tag.classList.add('tag');
//         tag.textContent = tagText;

//         const closeButton = document.createElement('span');
//         closeButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
//         closeButton.addEventListener('click', function () {
//             tagListContainer.removeChild(tag);
//         });

//         tag.appendChild(closeButton);

//         tagListContainer.appendChild(tag);
//     }
// });



// // sign out functions
// function showPopup() {
//     document.getElementById('overlay').style.display = 'block';
//     document.getElementById('popup').style.display = 'block';
// }

// function hidePopup() {
//     document.getElementById('overlay').style.display = 'none';
//     document.getElementById('popup').style.display = 'none';
// }

// function overlayClick(event) {
//     if (event.target.id === 'overlay') {
//         hidePopup();
//     }
// }

// function cancelSignOut() {
//     hidePopup();
// }

// function confirmSignOut() {
//     // Add any additional logic here before redirecting
//     window.location.href = 'shopNswap-login.html';
// }

//sign in functions
// var objPeople = [
//     {
//         username: "ysl",
//         password: "admin123",
//     },
//     {
//         username: "ice",
//         password: "ice123",
//     },
//     {
//         username: "123",
//         password: "acc123",
//     }
// ]

// function validate(event) {
//     event.preventDefault(); // Prevent the form from submitting
//     var username = document.getElementById("username").value;
//     var password = document.getElementById("password").value;

//     // Check if the entered credentials match one of the registered accounts
//     var isValidCredentials = objPeople.some(person => person.username === username && person.password === password);

//     if (isValidCredentials) {
//         showTermsModal(); // Show terms and conditions modal
//     } else {
//         // Check if the user has just signed up
//         var isNewUser = objPeople.some(person => person.username === username && person.password === password);

//         if (isNewUser) {
//             showTermsModal(); // Show terms and conditions modal for newly signed-up user
//         } else {
//             alert("Incorrect Username or Password");
//         }
//     }
// }





// document.addEventListener("DOMContentLoaded", () => {
//     const loginForm = document.querySelector("#login");
//     const createAccountForm = document.querySelector("#createAccount");

//     document.querySelector("#linkCreateAccount").addEventListener("click", e => {
//         e.preventDefault();
//         loginForm.classList.add("form--hidden");
//         createAccountForm.classList.remove("form--hidden");
//     });

//     document.querySelector("#linkLogin").addEventListener("click", e => {
//         e.preventDefault();
//         loginForm.classList.remove("form--hidden");
//         createAccountForm.classList.add("form--hidden");
//     });

//     loginForm.addEventListener("submit", e => {
//         e.preventDefault();

//         // Perform your AJAX/Fetch login

//         setFormMessage(loginForm, "error", "Invalid username/password combination");
//     });

//     document.querySelectorAll(".form__input").forEach(inputElement => {
//         inputElement.addEventListener("blur", e => {
//             if (e.target.id === "signupUsername" && e.target.value.length > 0 && e.target.value.length < 10) {
//                 setInputError(inputElement, "Username must be at least 10 characters in length");
//             }
//         });

//         inputElement.addEventListener("input", e => {
//             clearInputError(inputElement);
//         });
//     });
// });


// Append user input from registration to the var list for people accounts
// function createAccount(event) {
//     alert("Account Information submitted. Please wait for the approval message in your school email. Thank you!")
// }




//terms and condition pop up
// Your existing login script

// function showTermsModal() {
//     document.getElementById('termsModal').style.display = 'flex';
// }

// function acceptTerms() {
//     window.location.href = 'shopNswap-home.html';
// }

// function nevermind() {
//     window.location.href = 'shopNswap-login.html'; // Redirect back to login page
// }










// registration.js

// function createAccount(event) {

//     console.log("Submitting form...");
//     event.preventDefault();

//     // Retrieve form data
//     var email = document.getElementById('signupUsername').value;
//     var confirmEmail = document.getElementById('confirmEmail').value;
//     var password = document.getElementById('signupPassword').value;
//     var confirmPassword = document.getElementById('confirmPassword').value;
//     var corFile = document.getElementById('corFile').files[0];

//     // Validate input (you may add more validation logic here)
//     if (email === '' || confirmEmail === '' || password === '' || confirmPassword === '' || corFile === undefined) {
//         alert('Please fill in all fields and upload the Certificate of Registration.');
//         return;
//     }

//     // Check if email and confirm email match
//     if (email !== confirmEmail) {
//         alert('Email and Confirm Email must match.');
//         return;
//     }

//     // Check if password and confirm password match
//     if (password !== confirmPassword) {
//         alert('Password and Confirm Password must match.');
//         return;
//     }

//     // Prepare form data for AJAX
//     var formData = new FormData();
//     formData.append('email', email);
//     formData.append('password', password);
//     formData.append('corFile', corFile);

//     // Send AJAX request
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', 'sns-registration.php', true);
//     xhr.onload = function () {
//         if (xhr.status === 200) {
//             // Registration successful, handle the response if needed
//             console.log(xhr.responseText);
//         } else {
//             // Handle errors
//             console.error(xhr.statusText);
//         }
//     };

//     xhr.send(formData);
// }



