// Function to update the quantity of a product in the cart
function updateQty(productId, change) {
    // Use AJAX to send a request to updateQty.php
    $.ajax({
        url: 'updateQty.php',
        type: 'POST',
        data: { productId: productId, change: change },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                console.log(response.message);
                // Implement logic if needed
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

// Function to remove a product from the cart
function removeFromCart(productId) {
    // Use AJAX to send a request to removeFromCart.php
    $.ajax({
        url: 'removeFromCart.php',
        type: 'POST',
        data: { productId: productId },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                console.log(response.message);
                // Implement logic if needed
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