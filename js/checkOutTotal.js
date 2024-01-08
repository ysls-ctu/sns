function updateTotalToPay() {
    // Get the values of totalAmount and deliveryFee
    var totalAmount = parseFloat(document.getElementById('totalAmount').textContent) || 0;
    var deliveryFee = parseFloat(document.getElementById('deliveryFee').textContent) || 0;

    // Calculate the total to pay
    var totalToPay = totalAmount + deliveryFee;

    // Display the total to pay in the span
    document.getElementById('totalToPay').textContent = totalToPay.toFixed(2); // Assuming you want two decimal places
}

// Call the function initially
updateTotalToPay();

function updateTotalAmount() {
    var checkboxes = document.querySelectorAll('.cartItemCheckbox');
    var totalAmount = 0;

    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            // Get the data attributes from the checkbox
            var itemPrice = parseFloat(checkbox.getAttribute('data-price'));
            var itemQty = parseInt(checkbox.closest('.categoryContCart').querySelector('.categoryContCartQty span').textContent);

            // Calculate the total amount for the item
            var itemTotal = itemPrice * itemQty;

            // Update the total amount
            totalAmount += itemTotal;
        }
    });

    // Display the total amount in the span
    document.getElementById('totalAmount').textContent = totalAmount.toFixed(2); // Assuming you want two decimal places
    updateTotalToPay();

}

// Add event listeners to checkboxes to update the delivery fee when a checkbox is checked
var checkboxes = document.querySelectorAll('.cartItemCheckbox');
checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        // Update the delivery fee based on the checkbox status
        var deliveryFee = checkbox.checked ? 30.00 : 0.00;
        document.getElementById('deliveryFee').textContent = deliveryFee.toFixed(2);

        // After updating the delivery fee, call updateTotalAmount to recalculate the total amount
        updateTotalAmount();
    });
});