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

        <section id="cartContainer">
            <div class="cartSelectAll">
                <input type="checkbox">
                <span>Select All</span>
            </div>
            <div class="cartItems">
                <?php
                    include 'php/fetchCartItems.php'; // Include the PHP script to fetch cart items

                    // Use the function to fetch cart items
                    $cartItems = fetchCartItems();

                    // Loop through each cart item and generate the HTML
                    foreach ($cartItems as $cartItem) {
                        echo '<div id="cartContainer2" class="categoryContCart" data-product-id="' . $cartItem['PROD_ID'] . '">';
                        echo '  <div class="categoryContCartCheck"><input type="checkbox" class="cartItemCheckbox" data-price="' . $cartItem['PROD_PRICE'] . '"></div>';

                        // Check if the 'PROD_IMAGE' key exists before using it
                        if (isset($cartItem['PROD_IMAGE'])) {
                            echo '  <div class="categoryContCartImg"><img src="data:image/jpg;base64,' . base64_encode($cartItem['PROD_IMAGE']) . '" alt=""></div>';
                        }

                        echo '  <div class="categoryContCartDet">';
                        echo '    <center>';
                        echo '      <h4>' . (isset($cartItem['PROD_NAME']) ? $cartItem['PROD_NAME'] : 'Product Name Not Available') . '</h4>';
                        echo '      <p>Seller: ' . (isset($cartItem['USER_EMAIL']) ? $cartItem['USER_EMAIL'] : 'User Email Not Available') . '</p>';
                        echo '    </center>';
                        echo '  </div>';
                        echo '  <div class="categoryContCartPrice">';
                        echo '    <center><p>₱' . (isset($cartItem['PROD_PRICE']) ? $cartItem['PROD_PRICE'] : 'Price Not Available') . '</p></center>';
                        echo '  </div>';
                        echo '  <div class="categoryContCartX"><center><h5>X</h5></center></div>';
                        echo '  <div class="categoryContCartQty">';
                        echo '    <center>';
                        echo '      <button onclick="updateQty(' . $cartItem['PROD_ID'] . ', -1)"><i class="fa-solid fa-minus"></i></button>';
                        echo '      <span>' . $cartItem['CART_QTY'] . '</span>';
                        echo '      <button onclick="updateQty(' . $cartItem['PROD_ID'] . ', 1)"><i class="fa-solid fa-plus"></i></button>';
                        echo '    </center>';
                        echo '  </div>';
                        echo '  <div class="categoryContCartDelete"><center><i class="fa-solid fa-trash" onclick="removeFromCart(' . $cartItem['PROD_ID'] . ')"></i></center></div>';
                        echo '</div>';
                    }
                    ?>

            </div>
        </section>

        <section id="checkOutMenu">
            <div class="summaryMenu">
                <div id="editAddressOL" class="overlayAddress">
                    <!-- Modal Content -->
                    <div class="modalAddress">
                        <span class="closeAddress" id="closeModalAddress">&times;</span>
                        <p>Edit Your Delivery Address:</p>
                        <textarea id="addressTextarea" rows="4" placeholder="Enter your new delivery address"></textarea>
                        <button onclick="updateAddress()">Update Delivery Address</button>
                    </div>
                </div>
                <div>
                <?php
                    // Check if the user is logged in
                    if (isset($_SESSION['user'])) {
                        $userId = $_SESSION['user']['USER_ID'];

                        // Include the fetchAddress.php file
                        include 'php/fetchAddress.php';

                        // Fetch user address
                        $userAddress = fetchUserAddress($userId);

                        // Display user address in the HTML
                        echo '<div class="addressPart">';
                        echo '<div class="addressHead">';
                        echo '<h4>Delivery Address:&nbsp;&nbsp;</h4>';
                        echo '</div>';
                        echo '<div class="addressDisp">';
                        echo '<p>' . $userAddress . '</p>';
                        echo '</div>';
                        echo '<div class="addressEditButton">';
                        echo '<button id="openModalButton"><i class="fas fa-edit"></i></button>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<p>User not logged in</p>';
                    }
                ?>
                </div>
                <div class="orderSummary">
                    <div class="leftPart">
                        <h4>Order Summary</h4><br>
                        <span>Subtotal:</span> 
                        <span>Delivery Fee:</span>
                        <input type="text" placeholder="Enter Voucher Code">
                        <div class="totalCont">
                            <h4>Total:</h4>
                        </div>
                    </div>
                    <div class="rightPart">
                        <br><br>
                        <span id="totalAmount"></span>
                        <span id="deliveryFee">0.00</span>
                        <button>Apply</button>
                        <div class="totalPriceCont">
                            <center><span id="totalToPay"></span></center>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="opCont">
                <div class="overlay"></div>
                <div class="orderPlacePopup">
                    <!-- Popup content goes here -->
                </div>
            </div>
            <div class="paymentMenu">
                <center>
                    <b><p>We Accept:</p></b>
                    <a href="shopNswap-underConstruction.php">
                        <img src="payment1.png" alt="">
                        <img src="cod.png" alt="">
                    </a>
                </center>
                
            </div>
        </section>

        <section id="checkOut">
        <a>
            <div id="proceedCheckoutBtn" class="proceedCheckout">
                <center>
                    <p>Proceed to Checkout <i class="fa-solid fa-arrow-right"></i></p>
                </center>
            </div>
        </a>

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
        <script>
            
        </script>
        </body>


</html>