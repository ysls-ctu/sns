// Function to move hearted item to the cart
function moveToCart(productId) {
    // Use AJAX to send a request to moveHeartToCart.php
    $.ajax({
        url: 'php/moveToCart.php',
        type: 'POST',
        data: { productId: productId },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                alert(response.message);
                // Implement logic if needed
                location.reload(); // Reload the page after moving to cart
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




// Function to remove a product from the heart
function removeFromHeart(productId) {
    // Use AJAX to send a request to removeFromHeart.php
    $.ajax({
        url: 'php/removeFromHeart.php',
        type: 'POST',
        data: { productId: productId },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                // Display alert with the message
                alert(response.message);

                // Reload the page after the user clicks OK
                location.reload();
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
