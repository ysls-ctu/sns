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
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.0/css/all.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="shopNswap-home.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        
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

        <section id="searchContainer">
            <div class="searchBarClass">
                <input type="text" placeholder="" class="searchBarInput" id="searchInput">
                <a href="#" id="searchLink">
                    <button type="button" class="searchButton"><i class="fa fa-search"></i></button>
                </a>
            </div>
        </section>

        <section id="productBuy">
            <?php
                include 'php/fetchProduct.php';

                // Define the category based on the subCategory parameter from the URL
                $subCategory = $_GET['subCategory'] ?? ''; // Ensure to validate and sanitize user input

                // Use the function to fetch products based on the category
                $products = fetchProductsByCategoryFromDatabase($subCategory);

                // Loop through each product and generate the HTML
                foreach ($products as $product) {
                    echo '<div class="productCont">';
                    // Display the image using base64 encoding
                    echo '<img src="' . $product['PROD_IMAGE'] . '" alt="">';
                    echo '<h4>' . $product['PROD_NAME'] . '</h4>';
                    echo '<p>' . $product['PROD_SELLER'] . '</p>';
                    echo '<span>₱' . $product['PROD_PRICE'] . '</span>';
                    echo '<div class="productOptions">';
                    echo '<div class="iconOpt" onclick="addToCart(' . $product['PROD_ID'] . ')"><center><p>Add to Cart</p></center></div>';
                    echo '<div class="iconOpt heart" onclick="addToHeart(' . $product['PROD_ID'] . ')"><center><p>Add to Heart</p></center></div>';
                    echo '</div></div>';
                }

                // Function to fetch products based on category
                function fetchProductsByCategoryFromDatabase($category)
                {
                    $host = '127.0.0.1';
                    $user = 'root';
                    $pass = '';
                    $dbname = 'db_shopnswap';
                
                    // Establish a connection to the database
                    $conn = new mysqli($host, $user, $pass, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Ensure to validate and sanitize user input
                    $category = $conn->real_escape_string($category);

                    // Query to fetch products based on category
                    $query = "SELECT * FROM PRODUCT_tbl WHERE PROD_CATEGORY = '$category'";
                    $result = $conn->query($query);

                    // Check for query success
                    if ($result) {
                        $products = $result->fetch_all(MYSQLI_ASSOC);
                        $result->free_result();
                        $conn->close();
                        return $products;
                    } else {
                        echo "Error: " . $conn->error;
                        $conn->close();
                        return array(); // Return an empty array if there's an error
                    }
                }
            ?>
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

        <script src="js/addtoCartHeart.js"></script>
        <script src="js/checkoutDetails.js"></script>
        <script src="js/checkOutTotal.js"></script>
        <script src="js/editAddressPopup.js"></script>
        <script src="js/login.js"></script>
        <script src="js/moveRemoveHeart.js"></script>
        <script src="js/placeOrder.js"></script>
        <script src="js/register.js"></script>
        <script src="js/responsiveHeader.js"></script>
        <script src="js/review.js"></script>
        <script src="js/signout.js"></script>
        <script src="js/slideshow.js"></script>
        <script src="js/tagCreation.js"></script>
        <script src="js/updateAddress.js"></script>
        <script src="js/updateRemoveCart.js"></script>
 
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const searchBarInput = document.querySelector('.searchBarInput');
            const urlParams = new URLSearchParams(window.location.search);
            const subCategory = urlParams.get('subCategory');

            // object mapping for categories
            const categoryKeywords = {
                FOOD: ['Fries and Burger', 'Pizza', 'Milkshakes', 'Mac and Cheese', 'Potato Chips', 'Healthy Snacks',
                    'Dried Mango', 'Mango Float', 'Fruit Salad', 'Iced Coffee', 'Chicken Wings'],
                BOOKS: ['Academic Books', 'Young Adult', 'Economics', 'Horror and Mysteries', 'Music and Art', 'Engineering Books',
                    'History', 'Science and Health', 'Mathematics', 'Computer Programming', 'Science Fiction'],
                SUPPLIES: ['Ball Point Pen', 'Highlighter', 'Construction Paper', 'Yellow Pad', 'Measuring Tools', 'Correction Tape',
                    'Pencil', 'Backpack', 'Bond Paper', 'Adhesive Tools', 'Notebook'],
                CLOTHES: ['Dri-Fit', 'School Uniform', 'Men\'s Apparel', 'Women\'s Apparel', 'Shorts', 'White T-shirt',
                    'Jeans', 'Hoodies', 'Athletic Wear', 'Basketball Jersey', 'Socks'],
                LOAD: ['Smart 50', 'GoSurf 50', 'Globe 100', 'GO50', 'TNT', 'DITO Load',
                    'TM', 'Smart'],
                OTHERS: ['Miscellaneous', 'Others', 'New', 'Random']
            };
            const keywords = categoryKeywords[subCategory] || [];

            let index = 0;

            function updatePlaceholder() {
                searchBarInput.setAttribute('placeholder', keywords[index]);
                index = (index + 1) % keywords.length;
            }

            updatePlaceholder();
            setInterval(updatePlaceholder, 2000);
        });
        </script>

    </body>

</html>