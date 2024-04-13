/**
 * Add product to cart
 * @param {string} productId 
 */
function addProductInCart(productId) {
    fetch('?action=cartAdd&productId=' + productId,
        {
            method: 'GET',
            headers: {
                "Content-Type": "application/json"
            }
        }
    )
        .then(response => {
            if (response.ok) {
                return (response.json());       // return the Promise that contains the jsonObject of the response
            }
            return Promise.reject(new Error('status != 200'));    // reject if response not ok (ie. status != 200)
        })
        .then(jsonObject => {   // jsonObject contains the JavaScript literal object that contains the updated cart
            // update the (front-end) cart by DOM manipulation

            //###DEBUG
            
            console.log(jsonObject);
            // update the badge value
            let badge = document.querySelector(`#cartBadge`);
            //.innerHTML = jsonObject.length;
            //badge.innerHTML = parseInt(badge.innerHTML) + 1;
            badge.innerHTML = Object.keys(jsonObject).length;
            // test
            let input = document.querySelector(`#item2`);
            let td = input.parentElement;
            input.remove();
            td.innerHTML = "<a class='cta-button' onclick = 'myAlert (56);'>click</a>";
            

        })
        .catch(error => {
            console.log(error.message);
        })
}

function myAlert (text){
    alert("new test: " + text);
}



function updateProductInCart(productId) {
    const quantity = document.querySelector("#item" + productId).value;
    fetch('?action=cartUpdate&productId=' + productId + '&quantity=' + quantity,    // URL
        {
            method: 'GET', // GET, POST, PUT, DELETE, etc.
            headers: {
                "Content-Type": "application/json"
            }
        }
    )
        .then(response => {
            if (response.ok) {
                return (response.json());       // return the Promise that contains the jsonObject of the response
            }
            return Promise.reject(new Error('status != 200'));    // reject if response not ok (ie. status != 200)
        })
        .then(jsonObject => {   // jsonObject contains the JavaScript literal object that contains the updated cart
            // update the (front-end) cart by DOM manipulation

            cartContent(response);
            //###DEBUG
            console.log(jsonObject);

        })
        .catch(error => {
            console.log(error.message);
        })
}










// Badge
function updateCartBadge(count) {
    const badge = document.querySelector('#cartBadge');
    badge.innerHTML = count;
}

/*------ Cart display -------*/
function showCart(event) {
    cartModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function hideCart(event) {
    cartModal.style.display = "none";
}


// ouverture et fermeture du panier
function addAllListeners(event) {
    const cartButton = document.querySelector("#cartButton");
    if (cartButton) cartButton.addEventListener("click", showCart);

    // it could be shared among several modal contents
    const close = document.querySelector(".close");
    if (close) close.addEventListener("click", hideCart);

}

document.addEventListener("DOMContentLoaded", addAllListeners);







// Badge
function updateCartBadge(count) {
    const badge = document.querySelector('#cartBadge');
    badge.innerHTML = count;
}

/*------ Cart display -------*/
function showCart(event) {
    cartModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function hideCart(event) {
    cartModal.style.display = "none";
}


// ouverture et fermeture du panier
function addAllListeners(event) {
    const cartButton = document.querySelector("#cartButton");
    if (cartButton) cartButton.addEventListener("click", showCart);

    // it could be shared among several modal contents
    const close = document.querySelector(".close");
    if (close) close.addEventListener("click", hideCart);

}

document.addEventListener("DOMContentLoaded", addAllListeners);

