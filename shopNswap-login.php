<?php
    include 'php/login.php';
    include 'php/register.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>shopNswap.</title>
        <link rel="icon" type="image/x-icon" href="shopNswap-images/shopNswapLogo.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="shopNswap-login.css">
    </head>

    <body id="loginBody" class="animate">
        <div class="container">
            <div class="logo-container">
                <img src="shopNswap-images/shopNswapLogo2.png" alt="">
            </div>
            <form class="form" id="login">
                <h1 class="form__title text">
                    <div class="titleForm"><p>shopNswap.</p></div><br>
                    <span>Sign In</span>
                </h1>
                <div class="form__input-group">
                    <input type="text" class="form__input" autofocus placeholder="Email Address" id="username">
                </div>
                <div class="form__input-group">
                    <input type="password" class="form__input" autofocus placeholder="Password" id="password">
                </div>

                <button class="form__button" type="button" onclick="validateLogin()">
                    <span>Continue</span>
                </button>

                <div class="botText">
                    <p class="form__text">
                        <a href="shopNswap-underConstructionSignIn.php" class="form__link">Forgot your password?</a>
                    </p>

                    <p class="form__text">
                        <a class="form__link" href="#" id="linkCreateAccount">Don't have an account? Create account</a>
                    </p>
                </div>
                <input type="hidden" id="userId" name="userId">
            </form>
    
            <form class="form form--hidden" id="createAccount" >
                <h1 class="form__title text">
                    <div class="titleForm"><p>shopNswap.</p></div><br>
                </h1>
                <div class="form__message form__message--error"></div>
                <div class="form__input-group">
                    <input type="text" id="signupUsername" class="form__input" autofocus placeholder="Email Address">
                </div>
                <div class="form__input-group">
                    <input type="text" id="confirmEmail" class="form__input" autofocus placeholder="Confirm Email Address">
                </div>
                <div class="form__input-group">
                    <input type="password" id="signupPassword" class="form__input" autofocus placeholder="Password">
                </div>
                <div class="form__input-group">
                    <input type="password" id="confirmPassword" class="form__input" autofocus placeholder="Confirm password">
                </div>

                <button class="form__button" type="submit">Submit Information</button>
                <div class="botText">
                    <p class="form__text">
                        <a class="form__link" href="#" id="linkLogin">Already have an account? Sign in</a>
                    </p>
                </div>
            </form>
        </div>

        <div class="modal" id="termsModal">
            <div class="modal-content">
                <h2>Terms and Conditions</h2>
                <p>Please read and accept the terms and conditions before proceeding.</p>
                <div>
                These Terms and Conditions ("Agreement") are entered into by and between CTU SHOP N' SWAP and Shop Owners [Name of Shop] as of [Date].

1. Payment:

a. [Name of Shop] agree that customers of CTU Shop N' Swap shall make payment upon physical delivery of purchased items.

b. Payment through CTU Shop N' Swap web application is not required and shall not be processed. The application will solely require proof of payment for record-keeping purposes.

2. Proof of Payment:

a. Customer acknowledges that CTU Shop N' Swap web application will only require proof of payment via a picture or screenshot as evidence of the completed transaction.

b. CTU Shop N' Swap web application will not facilitate or process any payment transactions for the items sold by [Name of Shop].

3. Delivery:

a. CTU Shop N Swap shall ensure the safe and timely delivery of purchased items to customers at the agreed-upon location.

b. Upon delivery, customers shall inspect the items and make the payment directly to the respective [Name of Shop].

4. Dispute Resolution:

a. Any disputes arising from transactions facilitated by CTU Shop N' Swap shall be resolved through amicable discussions between CTU Shop N' Swap and the respective [Name of Shop] involved.

5. Governing Law:

a. This Agreement shall be governed by and construed in accordance with the laws of the Philippines.

By utilizing CTU Shop N' Swap and agreeing to have items sold and rented through CTU Shop N' Swap, [Name of Shop] hereby accept and agree to abide by these Terms and Conditions.
                </div>

                <div class="modal-buttons">
                    <button onclick="acceptTerms()">Accept</button>
                    <button onclick="nevermind()">Never mind</button>
                </div>
            </div>
        </div>
        <script src="js/login.js"></script>
        <script src="js/register.js"></script>
    </body>
</html>