<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
</div>
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
                <input type="text" placeholder="" class="searchBarInput">
                <a href="#">
                    <button type="button" class="searchButton"><i class="fa fa-search"></i></button>
                </a>
            </div>
        </section>

        <section>
            <section id="categoryContainerBuy">
                <a href="shopNswap-buySubCat.php?subCategory=FOOD">
                    <div class="categoryContBuy">
                        <i class="fas fa-utensils"></i>
                        <h1>FOOD</h1>
                    </div>
                </a>
                <a href="shopNswap-buySubCat.php?subCategory=BOOKS">
                    <div class="categoryContBuy">
                        <i class="fas fa-book-open"></i>
                        <h1>BOOKS</h1>
                    </div>
                </a>
                <a href="shopNswap-buySubCat.php?subCategory=SUPPLIES">
                    <div class="categoryContBuy">
                        <i class="fa-solid fa-pencil"></i>
                        <h1>SUPPLIES</h1>
                    </div>
                </a>
            </section>
    
            <section id="categoryContainerBuy">
                <a href="shopNswap-buySubCat.php?subCategory=CLOTHES">
                    <div class="categoryContBuy">
                        <i class="fa-solid fa-shirt"></i>
                        <h1>CLOTHES</h1>
                    </div>
                </a>
                <a href="shopNswap-buySubCat.php?subCategory=LOAD">
                    <div class="categoryContBuy">
                        <i class="fa-solid fa-mobile"></i>
                        <h1>LOAD</h1>
                    </div>
                </a>
                <a href="shopNswap-buySubCat.php?subCategory=OTHERS">
                    <div class="categoryContBuy">
                        <i class="fa-solid fa-ellipsis"></i>
                        <h1>OTHERS</h1>
                    </div>
                </a>
            </section>
        </section>

        <section id="productBuy">
            <?php
                include 'php/fetchProduct.php';

                // Use the function to fetch products
                $products = fetchProductsFromDatabase();

                // Loop through each product and generate the HTML
                foreach ($products as $product) {
                    echo '<div class="productCont">';
                    
                    // Display the image using the file path
                    echo '<img src="php/' . $product['PROD_IMAGE'] . '" alt="">';
                    
                    echo '<h4>' . $product['PROD_NAME'] . '</h4>';
                    echo '<p>' . $product['PROD_SELLER'] . '</p>';
                    echo '<span>₱' . $product['PROD_PRICE'] . '</span>';
                    
                    echo '<div class="productOptions">';
                    echo '<div class="iconOpt" onclick="addToCart(' . $product['PROD_ID'] . ')"><center><p>Add to Cart</p></center></div>';
                    echo '<div class="iconOpt heart" onclick="addToHeart(' . $product['PROD_ID'] . ')"><center><p>Add to Heart</p></center></div>';
                    echo '</div></div>';
                }
                
            ?>
        </section>

        <section id="ListContainer">
        <button class="ListButton" onclick="openModal()">
            <h1>List an item for sale</h1>
        </button>
            <button class="ListButton" onclick="redirectTo('shopNswap-underConstruction.php')">
                <h1>Manage items for sale</h1>
            </button>
        </section>

        <div class="overlayBuy" id="overlayBuy"></div>

        <div class="modalBuy" id="modalBuy">
            <form id="productForm" onsubmit="submitForm(); return false;">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required>

                <label for="productImage">Product Image:</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" required>

                <label for="productPrice">Product Price:</label>
                <input type="number" id="productPrice" name="productPrice" required>

                <label for="productStatus">Product Status:</label>
                <select id="productStatus" name="productStatus" required>
                    <option value="AVAILABLE">AVAILABLE</option>
                    <option value="PRE-ORDER">PRE-ORDER</option>
                </select>

                <label for="productCategory">Product Category:</label>
                <select id="productCategory" name="productCategory" required>
                    <option value="FOOD">FOOD</option>
                    <option value="BOOKS">BOOKS</option>
                    <option value="SUPPLIES">SUPPLIES</option>
                    <option value="CLOTHES">CLOTHES</option>
                    <option value="LOAD">LOAD</option>
                    <option value="OTHERS">OTHERS</option>
                </select>

                <button type="submit">Submit</button>
            </form>
            <button onclick="closeModal()">Close</button>
        </div>



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
                document.getElementById('overlayBuy').style.display = 'block';
                document.getElementById('modalBuy').style.display = 'block';
            }

            function closeModal() {
                document.getElementById('overlayBuy').style.display = 'none';
                document.getElementById('modalBuy').style.display = 'none';
            }

            function submitForm() {
                // Create FormData object
                var formData = new FormData();

                // Append form fields to FormData
                formData.append('productName', document.getElementById('productName').value);
                formData.append('productPrice', document.getElementById('productPrice').value);
                formData.append('productImage', document.getElementById('productImage').files[0]);
                formData.append('productStatus', document.getElementById('productStatus').value);
                formData.append('productCategory', document.getElementById('productCategory').value);

                // Add your AJAX code to submit form data to PHP script and insert into the database
                fetch('php/addProduct.php', {
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
                        alert('Product added successfully!');
                        location.reload(); // Reload the page
                    } else {
                        alert('Failed to add product. Error: ' + data.error);
                    }
                    closeModal();
                })
                .catch(error => console.error('Error:', error));
            }

        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchBarInput = document.querySelector('.searchBarInput');
                const keywords = ['School Supplies', 'Foods and Beverages', 'Secondhand Laptop', 'Academic Textbooks', 'Men and Women\'s Apparel',
                'Snacks', 'Smart Load', 'Stationary Set', 'Electronic and Devices', 'Sports and Recreation'];
                
                let index = 0;
        
                function updatePlaceholder() {
                    searchBarInput.setAttribute('placeholder', keywords[index]);
                    index = (index + 1) % keywords.length;
                }
                updatePlaceholder();
                setInterval(updatePlaceholder, 3000);
            });

        </script>
    </body>

</html>