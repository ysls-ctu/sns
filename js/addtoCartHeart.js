// Function to add a product to the cart
function addToCart(productId) {
    // Use AJAX to send a request to addToCart.php
    $.ajax({
        url: 'php/addToCart.php',
        type: 'POST',
        data: { productId: productId },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                // Display an alert for success messages
                alert(response.message);
            } else {
                console.error(response.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('An error occurred while processing the request.');
            console.error('Status: ' + textStatus);
            console.error('Error thrown: ' + errorThrown);
        }
    });
}

// Function to add a product to the heart
function addToHeart(productId) {
    // Use AJAX to send a request to addToHeart.php
    $.ajax({
        url: 'php/addToHeart.php',
        type: 'POST',
        data: { productId: productId },
        dataType: 'json', // Specify the expected data type
        success: function (response) {
            if (response.status === 'success') {
                console.log(response.message);
                alert('Product added to heart list!');
            } else if (response.status === 'error') {
                console.error(response.message);
                alert('Error: ' + response.message);
            }
        },
        error: function () {
            console.error('An error occurred while processing the request.');
        }
    });
}

