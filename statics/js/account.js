
function confirmDelete() {
    let confirmation = confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.");
    if (confirmation) {
        // Proceed with account deletion
        document.getElementById("deleteConfirmation").style.display = "block";
        document.querySelector('input[type="submit"]').disabled = true; // Disable submit button
        return true;
    } else {
        // Cancel account deletion
        return false;
    }
}