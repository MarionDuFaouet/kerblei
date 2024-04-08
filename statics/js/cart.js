function updateCartBadge(count) {
    const badge = document.querySelector('.cartBadge');
    badge.innerHTML = count; 
}

function showCart (event) {
    cartModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function hideCart (event) {
    cartModal.style.display = "none";
}

function addAllListeners (event) {
    const cartButton = document.querySelector (".cartButton");
    if (cartButton) cartButton.addEventListener("click", showCart);

    // it could be shared among several modal contents
    const close = document.querySelector (".close");
    if (close) close.addEventListener("click", hideCart);

    const cartModal = document.querySelector (".cartModal");
    if (cartModal) cartModal.addEventListener("click", hideCart);
}

document.addEventListener("DOMContentLoaded", addAllListeners);

