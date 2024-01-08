document.addEventListener('DOMContentLoaded', function() {
    // ... Your existing code ...

    // Add event listener to the "Proceed to Checkout" button
    document.getElementById('proceedCheckoutBtn').addEventListener('click', function() {
        // Gather information about selected items, total amount, etc.

        // For example, you can create an array to store information about selected items
        var selectedItems = [];

        var checkboxes = document.querySelectorAll('.cartItemCheckbox:checked');
        checkboxes.forEach(function (checkbox) {
            var cartItemContainer = checkbox.closest('.categoryContCart');
            var productName = cartItemContainer.querySelector('.categoryContCartDet h4').textContent;
            var quantity = cartItemContainer.querySelector('.categoryContCartQty span').textContent;
            var price = parseFloat(checkbox.getAttribute('data-price'));
            var totalPrice = price * quantity;

            // Push the information to the selectedItems array
            selectedItems.push({
                productName: productName,
                quantity: quantity,
                totalPrice: totalPrice.toFixed(2) // Assuming you want two decimal places
            });
        });

        // Get other information like total amount, delivery fee, delivery address, and estimated delivery date
        var totalAmount = parseFloat(document.getElementById('totalToPay').textContent) || 0;
        var deliveryFee = parseFloat(document.getElementById('deliveryFee').textContent) || 0; // Replace with your actual element
        var deliveryAddress = document.querySelector('.addressDisp p').textContent;
        var today = new Date();

        // Add one day to the current date
        var estimatedDeliveryDate = new Date(today);
        estimatedDeliveryDate.setDate(today.getDate() + 1);

        var formattedEstimatedDeliveryDate = estimatedDeliveryDate.toDateString();

        // Populate the content of the orderPlacePopup modal
        populateOrderPlacePopup(selectedItems, totalAmount, deliveryFee, deliveryAddress, estimatedDeliveryDate);

        // Show the orderPlacePopup modal and overlay
        var opCont = document.querySelector('.opCont');
        opCont.classList.add('show-popup');
    
    });
});
function closeOrderPlacePopup() {
    // Hide the overlay and popup by removing the 'show-popup' class from the .opCont element
    var opCont = document.querySelector('.opCont');
    opCont.classList.remove('show-popup');
}

function populateOrderPlacePopup(selectedItems, totalAmount, deliveryFee, deliveryAddress, formattedEstimatedDeliveryDate) {
    // Access the elements inside the orderPlacePopup modal and set their content based on the gathered information
    var opCont = document.querySelector('.opCont');
    var orderPlacePopup = document.querySelector('.orderPlacePopup');
    
    // Clear any previous content
    orderPlacePopup.innerHTML = '';

    // Add the content for each selected item
    selectedItems.forEach(function (item) {
        var itemInfo = document.createElement('p');
        itemInfo.textContent = `${item.productName} - Quantity: ${item.quantity} - Total: ₱${item.totalPrice}`;
        orderPlacePopup.appendChild(itemInfo);
    });

    // Add other information like total amount, delivery fee, delivery address, and estimated delivery date
    var deliveryFeeInfo = document.createElement('p');
    deliveryFeeInfo.textContent = `Delivery Fee: ₱${deliveryFee.toFixed(2)}`;

    var totalAmountInfo = document.createElement('p');
    totalAmountInfo.textContent = `Total Amount: ₱${totalAmount.toFixed(2)}`;

    var deliveryAddressInfo = document.createElement('p');
    deliveryAddressInfo.textContent = `Delivery Address: ${deliveryAddress}`;

    var estimatedDeliveryDateInfo = document.createElement('p');
    estimatedDeliveryDateInfo.textContent = `Estimated Delivery Date: ${formattedEstimatedDeliveryDate}`;
    
    orderPlacePopup.appendChild(totalAmountInfo);
    orderPlacePopup.appendChild(deliveryFeeInfo);
    orderPlacePopup.appendChild(deliveryAddressInfo);
    orderPlacePopup.appendChild(estimatedDeliveryDateInfo);

    // Add a close button or any other controls you need
    var closeButton = document.createElement('button');
    closeButton.textContent = 'Cancel';
    var placeOrderButton = document.createElement('button');
    placeOrderButton.textContent = 'Place Order';

    placeOrderButton.addEventListener('click', function() {
        // Gather information about selected items, total amount, etc.
        var selectedItems = [];
        var checkboxes = document.querySelectorAll('.cartItemCheckbox:checked');
    
        checkboxes.forEach(function (checkbox) {
            var cartItemContainer = checkbox.closest('.categoryContCart');
            var productIdElement = cartItemContainer.querySelector('.productId');
    
            if (productIdElement) {
                var productId = productIdElement.textContent;
                var quantity = cartItemContainer.querySelector('.categoryContCartQty span').textContent;
                var price = parseFloat(checkbox.getAttribute('data-price'));
                var totalPrice = price * quantity;
    
                // Push the information to the selectedItems array
                selectedItems.push({
                    PROD_ID: productId, // Update this line
                    quantity: quantity,
                    totalPrice: totalPrice.toFixed(2)
                });
            }
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
                    // Order placed successfully
                    alert('Order placed successfully');
    
                    // Remove the cart items that were ordered
                    checkboxes.forEach(function (checkbox) {
                        var cartItemContainer = checkbox.closest('.categoryContCart');
                        cartItemContainer.remove();
                    });
    
                    // Reload the page
                    location.reload();
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

        console.log('selectedItems:', selectedItems);
console.log('totalAmount:', totalAmount);
console.log('deliveryAddress:', deliveryAddress);

    
        // Close the orderPlacePopup modal
        opCont.classList.remove('show-popup');
    });
    
    
       

    closeButton.addEventListener('click', function() {
        // Close the orderPlacePopup modal
        opCont.classList.remove('show-popup');
    });
    orderPlacePopup.appendChild(closeButton);
    orderPlacePopup.appendChild(placeOrderButton);

    // Show the overlay and popup
    opCont.classList.add('show-popup');
}
