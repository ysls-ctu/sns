// Function to update the quantity of a product in the cart
function updateQty(productId, change) {
    // Use AJAX to send a request to updateQty.php
    $.ajax({
        url: 'php/updateQty.php',
        type: 'POST',
        data: { productId: productId, change: change },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                if (change < 0 && response.removed) {
                    // If the quantity is reduced to 0 or below and the item is removed, show an alert
                    alert('Item removed from the cart.');
                } else {
                    alert(response.message); // Show alert for other cases
                }
                location.reload(); // Reload the page
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
        url: 'php/removeFromCart.php',
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
