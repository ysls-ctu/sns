// Function to add a product to the cart
function addToCart(productId) {
    // Use AJAX to send a request to addToCart.php
    $.ajax({
        url: 'addToCart.php',
        type: 'POST',
        data: { productId: productId },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                console.log(response.message);
                alert('Product added to cart');
            } else {
                console.error(response.message);
                // Implement logic to handle errors
            }
        },
        error: function () {
            console.error('An error occurred while processing the request.');
            // Implement logic to handle errors
        }
    });
}

// Function to add a product to the heart
function addToHeart(productId) {
    // Use AJAX to send a request to addToHeart.php
    $.ajax({
        url: 'addToHeart.php',
        type: 'POST',
        data: { productId: productId },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                console.log(response.message);
                alert('Product added to heart list!');
            } else {
                console.error(response.message);
                // Implement logic to handle errors
            }
        },
        error: function () {
            console.error('An error occurred while processing the request.');
            // Implement logic to handle errors
        }
    });
}