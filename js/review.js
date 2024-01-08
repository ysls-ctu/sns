function openReceivedPop(orderId) {
    // Get the modal and overlay elements
    var modal = document.querySelector('.receivedCont');
    var overlay = document.querySelector('.overlayPop');

    // Populate the modal with order information
    // You can use AJAX to fetch additional details if needed

    // Display the modal and overlay
    modal.style.display = 'block';
    overlay.style.display = 'block';
    
    document.getElementById("submitReviewButton").addEventListener("click", function() {
        submitReview(orderId);
    });
}

function closeReceivedPop() {
    // Get the modal and overlay elements
    var modal = document.querySelector('.receivedCont');
    var overlay = document.querySelector('.overlayPop');

    // Hide the modal and overlay
    modal.style.display = 'none';
    overlay.style.display = 'none';
}

function submitReview(orderId) {
    // Get the rating and comment values
    var rating = document.getElementById("rating").value;
    var comment = document.getElementById("comment").value;

    // Perform any client-side validation if needed

    // Display an alert
    alert("Review has been sent! Thank you for your feedback.");
    
    // Close the modal (if needed)
    closeReceivedPop();
}
