document.addEventListener('DOMContentLoaded', function() {
    // Add event listener to the "Place Order" button
    document.getElementById('placeOrderButton').addEventListener('click', function() {
        // Gather information about selected items, total amount, etc.
        var selectedItems = [];
        var checkboxes = document.querySelectorAll('.cartItemCheckbox:checked');
        
        checkboxes.forEach(function (checkbox) {
            var cartItemContainer = checkbox.closest('.categoryContCart');
            var productId = cartItemContainer.querySelector('.productId').textContent;
            var quantity = cartItemContainer.querySelector('.categoryContCartQty span').textContent;
            var price = parseFloat(checkbox.getAttribute('data-price'));
            var totalPrice = price * quantity;

            // Push the information to the selectedItems array
            selectedItems.push({
                productId: productId,
                quantity: quantity,
                totalPrice: totalPrice.toFixed(2)
            });
        });

        var totalAmount = parseFloat(document.getElementById('totalToPay').textContent) || 0;
        var deliveryAddress = document.querySelector('.addressDisp p').textContent;

        // Make the AJAX request to the PHP script
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/placeOrder.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    // Order placed successfully, you can handle this based on your needs
                    console.log('Order placed successfully');
                } else {
                    // Handle the error case
                    console.error('Failed to place order:', response.message);
                }
            }
        };

        // Prepare the data to send to the server
        var data = 'selectedItems=' + encodeURIComponent(JSON.stringify(selectedItems)) +
                   '&totalAmount=' + encodeURIComponent(totalAmount) +
                   '&deliveryAddress=' + encodeURIComponent(deliveryAddress);

        // Send the request
        xhr.send(data);
    });
});
