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
        <script src="js/addtoCartHeart.js"></script>
        
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

                $rent = fetchRentByCategoryFromDatabase($subCategory);

                // Loop through each product and generate the HTML
                foreach ($rent as $rent) {
                    echo '<div class="productCont">';
                    
                    // Display the image using the file path
                    echo '<img src="php/' . $rent['RENT_IMAGE'] . '" alt="">';
                    
                    echo '<h4>' . $rent['RENT_NAME'] . '</h4>';
                    echo '<p>' . $rent['RENT_OWNER'] . '</p>';
                    echo '<span>₱' . $rent['RENT_PRICE'] . ' per hour</span>';
                    echo '<div class="$rent">';
                    echo '<div class="iconOpt" onclick="sendRentalRequest(' . $rent['USER_ID'] . ')"><center><p>Send Rental Request</p></center></div>';
                    echo '</div></div>';

                    
                }

                function fetchRentByCategoryFromDatabase($category)
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

                    $query = "SELECT * FROM RENT_tbl WHERE RENT_CATEGORY = '$category'";
                    $result = $conn->query($query);

                    // Check for query success
                    if ($result) {
                        $rent = $result->fetch_all(MYSQLI_ASSOC);
                        $result->free_result();
                        $conn->close();
                        return $rent;
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
            function openModal() {
                document.getElementById('overlayRent').style.display = 'block';
                document.getElementById('modalRent').style.display = 'block';
            }

            function closeModal() {
                document.getElementById('overlayRent').style.display = 'none';
                document.getElementById('modalRent').style.display = 'none';
                document.getElementById('overlayRentRequest').style.display = 'none';
                document.getElementById('modalRentRequest').style.display = 'none';
            }

            function sendRentalRequest() {
                document.getElementById('overlayRentRequest').style.display = 'block';
                document.getElementById('modalRentRequest').style.display = 'block';
            }

            function submitRentList() {
                var formData = new FormData();
                formData.append('rentName', document.getElementById('rentName').value);
                formData.append('rentPrice', document.getElementById('rentPrice').value);
                formData.append('rentImage', document.getElementById('rentImage').files[0]);
                formData.append('rentCategory', document.getElementById('rentCategory').value);

                // Add your AJAX code to submit form data to PHP script and insert into the database
                fetch('php/addRent.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        alert('Rental product listed successfully!');
                        location.reload(); // Reload the page
                    } else {
                        alert('Failed to add rental product. Error: ' + data.error);
                    }
                    closeModal();
                })
                .catch(error => console.error('Error:', error));
            }

            function submitRentReq() {
                var formData = new FormData();
                formData.append('rentreqDur', document.getElementById('rentreqDur').value);
                formData.append('rentreqComment', document.getElementById('rentreqComment').value);

                // Add your AJAX code to submit form data to PHP script and insert into the database
                fetch('php/addRentRequest.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        alert('Rent Request submitted successfully!');
                        location.reload(); // Reload the page
                    } else {
                        alert('Failed to send rent request. Error: ' + data.error);
                    }
                    closeModal();
                })
                .catch(error => console.error('Error:', error));
            }
        </script>

        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const searchBarInput = document.querySelector('.searchBarInput');
            const urlParams = new URLSearchParams(window.location.search);
            const subCategory = urlParams.get('subCategory');

            // object mapping for categories
            const categoryKeywords = {
                LAPTOP: ['ASUS', 'Apple Macbook', 'Lenovo', 'MSI', 'Razer', 'HP',
                    'Samsung', 'Dell', 'ASUS ROG'],
                CALCULATOR: ['Casio', 'Canon', 'Sharp', 'Hewlett-Packard'],
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