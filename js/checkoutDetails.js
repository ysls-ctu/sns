document.addEventListener('DOMContentLoaded', function () {
    var proceedCheckoutBtn = document.getElementById('proceedCheckoutBtn');
    var placeOrderButton; // Declare the placeOrderButton variable

    proceedCheckoutBtn.addEventListener('click', function () {
        var selectedItems = [];
        var checkboxes = document.querySelectorAll('.cartItemCheckbox:checked');

        checkboxes.forEach(function (checkbox) {
            var cartItemContainer = checkbox.closest('.categoryContCart');
            var productName = cartItemContainer.querySelector('.categoryContCartDet h4').textContent;
            var quantity = cartItemContainer.querySelector('.categoryContCartQty span').textContent;
            var price = parseFloat(checkbox.getAttribute('data-price'));
            var productId = checkbox.getAttribute('data-product-id'); // Adjust this line based on your HTML
        
            var totalPrice = price * quantity;
        
            // Push the information to the selectedItems array
            selectedItems.push({
                productName: productName,
                quantity: quantity,
                totalPrice: totalPrice.toFixed(2),
                productId: productId // Include the product ID
            });
        });
        

        var totalAmount = parseFloat(document.getElementById('totalToPay').textContent) || 0;
        var deliveryFee = parseFloat(document.getElementById('deliveryFee').textContent) || 0;
        var deliveryAddress = document.querySelector('.addressDisp p').textContent;

        // Use FormData to properly serialize the data
        var formData = new FormData();
        formData.append('selectedItems', JSON.stringify(selectedItems));
        formData.append('totalAmount', totalAmount);
        formData.append('deliveryAddress', deliveryAddress);

        // Populate the content of the orderPlacePopup modal
        populateOrderPlacePopup(selectedItems, totalAmount, deliveryFee, deliveryAddress);

        // Show the orderPlacePopup modal and overlay
        var opCont = document.querySelector('.opCont');
        opCont.classList.add('show-popup');

        // Dynamically create the "Place Order" button inside the modal
        placeOrderButton = document.createElement('button');
        placeOrderButton.textContent = 'Place Order';

        // Add event listener to the dynamically created "Place Order" button
        placeOrderButton.addEventListener('click', function () {
            // Call the function to send data to the server
            sendOrderDataToServer(formData);
        });
        document.querySelector('.orderPlacePopup').appendChild(placeOrderButton);

    });

    function sendOrderDataToServer(formData) {
        // Send data to the server using AJAX
        console.log('Sending order data to server...');
        var xhr = new XMLHttpRequest();
        var url = 'php/placeorder.php'; // Replace with the actual path to your PHP script
    
        xhr.open('POST', url, true);
        // Do not set Content-Type here, let the browser set it automatically for FormData
    
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                console.log(xhr.responseText); // Log the raw response
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        // Handle success
                        console.log(response.message);
    
                        // Show an alert
                        alert('Order placed successfully!');
    
                        // Close the orderPlacePopup modal
                        closeOrderPlacePopup();
    
                        // Remove the cart items that were ordered
                        checkboxes.forEach(function (checkbox) {
                            var cartItemContainer = checkbox.closest('.categoryContCart');
                            cartItemContainer.remove();
                        });
    
                        // Reload the page
                        location.reload();
                    } else {
                        // Handle error
                        console.error(response.message);
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            }
        };
    
        xhr.send(formData);
    }

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
            itemInfo.textContent = `- ${item.productName} X ${item.quantity} = ₱${item.totalPrice}`;
            orderPlacePopup.appendChild(itemInfo);
        });
    
        // Add other information like total amount, delivery fee, delivery address, and estimated delivery date
        var deliveryFeeInfo = document.createElement('p');
        deliveryFeeInfo.textContent = `Delivery Fee: ₱${deliveryFee.toFixed(2)}`;
    
        var totalAmountInfo = document.createElement('p');
        totalAmountInfo.innerHTML = `<strong>Total to Pay:</strong> ₱${totalAmount.toFixed(2)}`;

    
        var deliveryAddressInfo = document.createElement('p');
        deliveryAddressInfo.textContent = `Delivery Address: ${deliveryAddress}`;
    
        var estimatedDeliveryDateInfo = document.createElement('p');
        var estimatedDeliveryDate = new Date();
        estimatedDeliveryDate.setDate(estimatedDeliveryDate.getDate() + 1);

        var newSpace = document.createElement('br')
        var newSpace2 = document.createElement('br')

        // Format the date for display
        var formattedEstimatedDeliveryDate = estimatedDeliveryDate.toDateString();

        estimatedDeliveryDateInfo.textContent = `Estimated Delivery Date: ${formattedEstimatedDeliveryDate}`;
        
        orderPlacePopup.appendChild(newSpace);
        orderPlacePopup.appendChild(deliveryFeeInfo);
        orderPlacePopup.appendChild(totalAmountInfo);
        orderPlacePopup.appendChild(newSpace2);
        orderPlacePopup.appendChild(deliveryAddressInfo);
        orderPlacePopup.appendChild(estimatedDeliveryDateInfo);
    
        // Add a close button or any other controls you need
        var closeButton = document.createElement('button');
        closeButton.textContent = 'Cancel';
        var placeOrderButton = document.createElement('button');
        placeOrderButton.textContent = 'Place Order';
    
        placeOrderButton.addEventListener('click', function () {
            // Here, you can use the selectedItems array to send data to the server
            console.log('Selected Items:', selectedItems);
    
            // Close the orderPlacePopup modal
            opCont.classList.remove('show-popup');
        });
    
        closeButton.addEventListener('click', function () {
            // Close the orderPlacePopup modal
            opCont.classList.remove('show-popup');
        });
    
        orderPlacePopup.appendChild(closeButton);
    
        // Show the overlay and popup
        opCont.classList.add('show-popup');
    }
    
});

