// Example JavaScript (Ensure this is not hiding the button)
function openModal() {
    document.getElementById("editAddressOL").style.display = "flex";
}

function closeModal() {
    document.getElementById("editAddressOL").style.display = "none";
}

// Event listener for the open modal button
document.getElementById("openModalButton").addEventListener("click", openModal);

// Event listener for the close button in the modal
document.getElementById("closeModalAddress").addEventListener("click", closeModal);

// Event listener for clicking outside the modal to close it
window.addEventListener("click", function(event) {
    if (event.target == document.getElementById("editAddressOL")) {
        closeModal();
    }
});
