<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>

<html lang="en">

    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title>shopNswap.</title>
        <link rel="icon" type="image/x-icon" href="shopNswap-images/shopNswapLogo.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="shopNswap-home.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="shopNswap-home.js"></script>
        
    </head>

    <body id="bodyCont">

        <section id="header">
                <div class="topnav" id="myTopnav">
                    <a href="shopNswap-home.php" class="logo">
                        <img src="shopNswap-images/shopNswapLogo2.svg" alt="">
                    </a>
                    <a href="shopNswap-home.php" class="siteName"><p>shopNswap.</p></a>
                    <a href="#" class="icon1" onclick="showPopup()">
                        <i class="fa-solid fa-sign-out-alt"></i><span class="extra-content">Sign Out</span>
                    </a>
                    <div class="overlay" id="overlay" onclick="hidePopup()"></div>

                    <div class="popup" id="popup">
                        <i class="fa-solid fa-face-frown fa-shake"></i>
                        <p>Are you sure you want to sign out?</p>
                        <div class="popup-buttons">
                            <button onclick="cancelSignOut()">No</button>
                            <button onclick="confirmSignOut()">Yes</button>
                        </div>
                    </div>

                    <a href="shopNswap-profile.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>" class="icon1"><i class="fa-solid fa-user"></i><span class="extra-content">User Settings</span></a>
                    <a href="shopNswap-cart.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>" class="icon1"><i class="fa-solid fa-cart-shopping"></i><span class="extra-content">Shop Cart</span></a>
                    <a href="shopNswap-heart.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>" class="icon1"><i class="fa-solid fa-heart"></i><span class="extra-content">Liked Items</span></a>
                    <a href="shopNswap-message.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>" class="icon1"><i class="fa-solid fa-envelope"></i><span class="extra-content">Messages</span></a>
                    <a href="javascript:void(0);" class="icon" onclick="toggleMenu()">
                    <i class="fa fa-bars"></i>
                    </a>
                </div>
        </section>

        <section id="banner">
            <a href="shopNswap-underConstruction.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>" class="container1">
                <div class="col1">
                    <i class="fas fa-share"></i>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="col2">
                    <center>
                        <h3>SHARE & EARN</h3>
                        <p>up to 10% off</p>
                    </center>
                </div>
            </a>
            <a href="shopNswap-underConstruction.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>" class="container2">
                <div class="col1">
                    <i class="fa-solid fa-tags"></i>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="col2">
                    <center>
                        <h3>GET ₱100 OFF DISCOUNT</h3>
                        <p>on your first order</p>
                    </center>
                </div>
            </a>
            <a href="shopNswap-underConstruction.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>" class="container2">
                <div class="col1">
                    <i class="fa-solid fa-credit-card"></i>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="col2">
                    <center>
                        <h3>EXCLUSIVE OFFERS</h3>
                        <p>for bonafide students</p>
                    </center>
                </div>
            </a>
            <a href="shopNswap-underConstruction.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>" class="container2">
                <div class="col1">
                    <i class="fa-solid fa-gift"></i>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="col2">
                    <center>
                        <h3>EXCITING VOUCHERS</h3>
                        <p>student-friendly offers</p>
                    </center>
                </div>
            </a>
        </section>

        <section id="profileCont">
        <div class="receivedCont">
            <div class="receivedReviewPop">
                <p>Rate the order:</p>
                <select id="rating" name="rating">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <textarea id="comment" name="comment" placeholder="Enter your comment"></textarea>
                <button onclick="closeReceivedPop()">Close</button>
                <button onclick="submitReview()">Submit</button>
            </div>
        </div>
        <div class="overlayPop"></div>

            <div class="red-div">
                <img src="shopNswap-images/shopNswapLogo2.svg" alt="">
                <input type="file" id="uploadPic" style="display: none;">
                <div class="detCont">
                <?php
                    if (isset($_SESSION['user'])) {
                    $userId = $_SESSION['user']['USER_ID'];

                    include 'php/fetchEmail.php';

                    // Fetch user email
                    $userEmail = fetchUserEmail($userId);
                    $userAddress = fetchUserAddress($userId);
                    $userReg = fetchUserReg($userId);
                    } else {
                        echo '<p>User not logged in</p>';
                    }
                ?>
                    <div class="contentRow">
                        <p>Email: </p>
                        <span id="emailAddressDisp"><?php echo $userEmail; ?></span>
                    </div>
                    <div class="contentRow">
                        <p>Address: </p>
                        <span id="addressDisp"><?php echo $userAddress; ?></span>
                    </div>
                    <div class="contentRow">
                        <p>Registration Date: </p>
                        <span id="regDisp"><?php echo $userReg; ?></span>
                    </div>
                </div>
                <div class="buttonCont">
                    <button id="editButton">Edit Information</button>
                    <button id="discardButton" style="display: none;">Discard</button>
                    <button id="updateButton" style="display: none;">Update</button>
                </div>
                
            </div>
            
            <div class="green-div">
                <div class="statusCont">
                    <button data-section="all">ALL</button>
                    <button data-section="toPay">TO PAY</button>
                    <button data-section="toShip">TO SHIP</button>
                    <button data-section="toReceive">TO RECEIVE</button>
                    <button data-section="completed">COMPLETED</button>
                    <button data-section="cancelled">CANCELLED</button>
                </div>
                <div class="section-container" data-section="all">
                    <div class="itemsCont">
                        <div class="storeName">
                            <p>Store Name</p>
                            <a href="shopNswap-underConstruction.html">
                                <div class="visitSeller">
                                    <span><i class="fa-solid fa-store"></i>&nbsp;Visit Shop</span>
                                </div>
                            </a>
                        </div>
                        <div class="paCont">
                            <?php
                                if (isset($_SESSION['user'])) {
                                    $userId = $_SESSION['user']['USER_ID'];

                                    include 'php/fetchOrders.php';

                                    // Fetch all orders with ORDER_STATUS "TO RECEIVE" for the user
                                    $result = fetchUserOrders($userId, "TO RECEIVE");

                                    $userOrders = $result['userOrders'];
                                    $totalToReceive = $result['totalToReceive'];

                                    // Check if the user has any orders with ORDER_STATUS "TO RECEIVE"
                                    if ($userOrders) {
                                        // Loop through each order and display details
                                        foreach ($userOrders as $orderDetails) {
                                            echo '<div class="productArea">';
                                            echo '<div class="paCol" id="titleCont">';
                                            echo '<p id="orderNumber"><b>Order ID:</b> ' . $orderDetails['ORDER_ID'] . '</p>';
                                            echo '<p id="orderAddress"><b>Delivery Address:</b><i> ' . $orderDetails['ORDER_ADDRESS'] . '</i></p><br>';
                                            echo '<p id="orderStatus"><b>Order Status:</b> ' . $orderDetails['ORDER_STATUS'] . '</p>';
                                            echo '</div>';
                                            echo '<div class="paCol" id="priceCont">';
                                            echo '<p id="orderTotal">Total: ' . $orderDetails['ORDER_AMOUNT'] . '</p>';
                                            echo '</div>';
                                            echo '<div class="paCol" id="receiveButton">';
                                            echo '<button onclick="openReceivedPop(' . $orderDetails['ORDER_ID'] . ')">Received</button>';
                                            echo '</div>';
                                            echo '</div>';
                                        }

                                        // Close the paCont div here
                                        echo '</div>';

                                        // Open the orderActions div here
                                        echo '<div class="orderActions">';
                                        echo '<button id="csbtn" >Contact Seller</button>';
                                        echo '<button>Cancel Order</button>';
                                        echo '<p>Total: <b id="displayOrderTotal">' . $totalToReceive . '</b></p>';
                                        echo '</div>';
                                    } else {
                                        echo '<p>No orders found with ORDER_STATUS "TO RECEIVE" for the user</p>';
                                    }
                                } else {
                                    echo '';
                                }
                            ?>




                        </div> 



                    </div>
                </div>
                <div class="section-container" data-section="toPay">
                <!-- Content for the "TO PAY" section -->
                </div>
                <div class="section-container" data-section="toShip">
                    <!-- Content for the "TO SHIP" section -->
                </div>
                <div class="section-container" data-section="toReceive">
                    <!-- Content for the "TO RECEIVE" section -->
                </div>
                <div class="section-container" data-section="completed">
                    <!-- Content for the "COMPLETED" section -->
                </div>
                <div class="section-container" data-section="cancelled">
                    <!-- Content for the "CANCELLED" section -->
                </div>

            </div>
        </section>
        
        <footer class="footerCont">
            <div class="footerCont2">
                <div class="footerCol">
                    <a href="shopNswap-home.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <div class="footerColHead">
                            <img src="shopNswap-images/shopNswapLogo2.svg" alt="">
                            <p>shopNswap.</p>
                        </div>
                    </a><br>
                    <a href="https://shorturl.at/pN028">
                        <p>Corner M.J. Cuenco Ave. & R. Palma St.,Cebu City, Philippines, 6000</p>
                    </a>
                    <p>123-1234</p>
                    <a href="https://www.google.com/gmail/about/">
                        <p>cs@shopnswap.com</p>
                    </a>
                    <span>Follow Us</span>
                    <div class="footerColHead">
                        <a href="https://www.facebook.com/edsel.lucanas">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://www.twitter.com/">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://www.pinterest.com/">
                            <i class="fa-brands fa-pinterest"></i>
                        </a>
                        <a href="https://www.youtube.com/">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div class="footerCol">
                    <span>About</span>
                    <a href="shopNswap-team.php">
                        <p>About Us</p>
                    </a>
                    <a href="shopNswap-underConstruction.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>Delivery Information</p>
                    </a>
                    <a href="shopNswap-underConstruction.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>Shipping Rates and Policies</p>
                    </a>
                    <a href="shopNswap-underConstruction.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>Privacy Policy</p>
                    </a>
                    <a href="shopNswap-tnc.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>Terms and Conditions</p>
                    </a>
                    <a href="shopNswap-contactus.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>Contact Us</p>
                    </a>
                </div>
                <div class="footerCol">
                    <span>Account</span>
                    <a href="shopNswap-profile.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>Account Settings</p>
                    </a>
                    <a href="shopNswap-profile.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>Track My Order</p>
                    </a>
                    <a href="shopNswap-cart.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>View Cart</p>
                    </a>
                    <a href="shopNswap-heart.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>View Heart List</p>
                    </a>
                    <a href="shopNswap-cart.php?userID=<?php echo isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : ''; ?>">
                        <p>View Orders</p>
                    </a>
                </div>
            </div>
            <div class="footerCont2">
                <a href="#" class="backTop">Back to top&nbsp;&nbsp;<i class="fa-solid fa-arrow-up"></i></a>
                <div class="footDesign">
                    
                </div>
            </div>
        </footer>

        <script src="js/responsiveHeader.js"></script>
        <script src="js/signout.js"></script>
        <script src="js/updateRemoveCart.js"></script>
        <script src="js/editAddressPopupjs"></script>
        <script src="js/updateAddress.js"></script>
        <script src="js/checkOutTotal.js"></script>
        <script src="js/checkOutDetails.js"></script>
        <script src="js/review.js"></script>

        <script>
            function toggleMenu() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                var editButton = document.getElementById('editButton');
                var discardButton = document.getElementById('discardButton');
                var updateButton = document.getElementById('updateButton');
                var uploadPic = document.getElementById('uploadPic');

                editButton.addEventListener('click', function () {
                    discardButton.style.display = 'inline-block';
                    updateButton.style.display = 'inline-block';
                    uploadPic.style.display = 'inline-block';
                    editButton.style.display = 'none';
                });

                discardButton.addEventListener('click', function () {
                    discardButton.style.display = 'none';
                    updateButton.style.display = 'none';
                    uploadPic.style.display = 'none';
                    editButton.style.display = 'inline-block';
                });
                
            });

            document.addEventListener('DOMContentLoaded', function () {
                var allButton = document.querySelector('.statusCont button[data-section="all"]');
                var toPayButton = document.querySelector('.statusCont button[data-section="toPay"]');
                var toShipButton = document.querySelector('.statusCont button[data-section="toShip"]');
                var toReceiveButton = document.querySelector('.statusCont button[data-section="toReceive"]');
                var completedButton = document.querySelector('.statusCont button[data-section="completed"]');
                var cancelledButton = document.querySelector('.statusCont button[data-section="cancelled"]');

                var sections = document.querySelectorAll('.section-container');

                function showSection(sectionToShow) {
                    sections.forEach(function (section) {
                        if (section.getAttribute('data-section') === sectionToShow) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                }

                allButton.addEventListener('click', function () {
                    showSection('all');
                });

                toPayButton.addEventListener('click', function () {
                    showSection('toPay');
                });

                toShipButton.addEventListener('click', function () {
                    showSection('toShip');
                });

                toReceiveButton.addEventListener('click', function () {
                    showSection('toReceive');
                });

                completedButton.addEventListener('click', function () {
                    showSection('completed');
                });

                cancelledButton.addEventListener('click', function () {
                    showSection('cancelled');
                });
            });

            document.addEventListener('DOMContentLoaded', function () {
                var csButton = document.getElementById('csbtn');

                csButton.addEventListener('click', function () {
                    window.location.href = 'shopNswap-message.html';
                });
            });


        </script>



    </body>
    
</html>