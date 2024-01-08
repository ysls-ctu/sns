function updateAddress() {
    // Get the new address from the textarea
    var newAddress = document.getElementById("addressTextarea").value;

    // Make an AJAX request to send the data to the server
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from the server
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                // Close the modal or provide feedback to the user
                alert("Delivery address updated.");
                closeModal();
                // Reload the page
                window.location.reload();
            } else {
                // Handle errors or display a message to the user
                alert("Failed to update address. Please try again.");
            }
        }
    };

    // Prepare the data to be sent to the server
    var data = "newAddress=" + encodeURIComponent(newAddress);

    // Send the request to the server (replace 'update_address.php' with your server-side script)
    xhr.open("POST", "php/updateAddress.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(data);
}
