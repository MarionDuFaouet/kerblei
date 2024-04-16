
/*-----------------------------------------------
 *  Event handling
 *-----------------------------------------------*/

/**
 * Add a product item to cart from the page that presents all the products.
 * @param {string} productId - identifier of the product for which an item is being added.
 */

function addProductInCart(element, productId) {

    // search if the type product is already in the cart
    const product = document.querySelector("#product-" + productId);
    if (product == null) {
        // product not yet known in the cart -> add an empty (template) row
        // that will updated at the return of the async call to the backend
        addCartRow(productId);  
    }
    
    // updated the backend for "addProduct" front action
    fetch('?action=cartAdd',    // URL
        {
            method: 'POST', // GET, POST, PUT, DELETE, etc.
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "productId": productId
            })
        }
    )
        .then(response => {
            if (response.ok) {
                return (response.json());       // return the Promise that contains the jsonObject of the response
            }
            return Promise.reject(new Error('status != 200'));    // reject if response not ok (ie. status != 200)
        })
        .then(jsonObject => {   
            // jsonObject contains the JavaScript literal object that contains the updated cart
            const total = synchronizeCart(jsonObject);
            // update total amount of the cart
            updateTotal(total);
            // update the badge value
            updateCartBadge(Object.keys(jsonObject.products).length);
            // refresh message
            updateCartMessage(jsonObject);
        })
        .catch(error => {
            console.log(error.message);
        })
}

/**
 * Remove a product (all the items) from the cart (when click on trash)
 * @param {Object} element - .
 */

function deleteProductInCart(element) {

    productId = element.parentElement.parentElement.dataset.id;
    removeCartRow(productId);
    updateCart(productId, 0);
}


/**
 * Remove/Add one item (of a product) from the cart.
 * @param {HTML Element} element - HTML element that has triggered the handler.
 */

function decrProductInCart(element) {
    updateProductInCart(element, -1);
}

function incrProductInCart(element) {
    updateProductInCart(element, 1);
}

function updateProductInCart(element, delta) {
    productId = element.parentElement.parentElement.dataset.id;     // get productId near <tr>
    const quantityElement = document.querySelector("#cartQuantity-" + productId);
    let updatedQuantityValue = parseInt(quantityElement.value) + delta;
    if (updatedQuantityValue <= 0) {
        removeCartRow(productId);        // see Note(1) 
        updatedQuantityValue = "0";
    }
    updateCart(productId, updatedQuantityValue);
}

/**
 * Modify the quantity of an item in the cart, 
 * remove the product line if the quantity reaches 0 and send the cart to the backend
 * Note(1) : If a product(its row) is fully removed, the cart does not need to be refreshed when fetch return.
 * @param {HTML Element} element - L'élément déclencheur.
 * @param {int} quantity - variation de quantité.
 */

function updateCart(productId, newQuantityValue) {
    // console.log ("updateProductInCart " + productId + " quantity: " + updatedQuantityValue);

    fetch('?action=cartUpdate',    // URL
        {
            method: 'POST', // GET, POST, PUT, DELETE, etc.
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "productId": productId,
                "productQuantity": newQuantityValue
            })
        }
    )
        .then(response => {
            if (response.ok) {
                return (response.json());       // return the Promise that contains the jsonObject of the response
            }
            return Promise.reject(new Error('status != 200'));    // reject if response not ok (ie. status != 200)
        })
        .then(jsonObject => {
            total = synchronizeCart(jsonObject);
            // update total amount of the cart
            updateTotal(total);
            // update the badge value
            updateCartBadge(Object.keys(jsonObject.products).length);
            // refresh message
            updateCartMessage(jsonObject);
        })
        .catch(error => {
            console.log(error.message);
        })
}


/**
 * Add a product item to cart from the page that presents all the products.
 */

function validateCart() {

    // search if the type product is already in the cart
    const deliveryDate = document.querySelector("#cartDate").value;
    if (deliveryDate === "") {return;}          // it should not happen
    
    // updated the backend for "addProduct" front action
    fetch('?action=cartValidate',    // URL
        {
            method: 'POST', // GET, POST, PUT, DELETE, etc.
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "deliveryDate": deliveryDate
            })
        }
    )
        .then(response => {
            if (response.ok) {
                return (response.json());       // return the Promise that contains the jsonObject of the response
            }
            return Promise.reject(new Error('status != 200'));    // reject if response not ok (ie. status != 200)
        })
        .then(jsonObject => {   
            // jsonObject contains the JavaScript literal object that contains the updated cart
            
            // if action is requested
            if ((typeof (jsonObject.action) == 'string') && jsonObject.action === 'DROP') {
                removeAllCartRow();
                updateTotal(0);
                updateCartBadge(0);
            }
            // refresh message if this is one
            updateCartMessage(jsonObject);
        })
        .catch(error => {
            console.log(error.message);
        })
}


/*-----------------------------------------------
 *  Table & Row management for the cart
 *-----------------------------------------------*/

/* ---------------------------------------------------------------
    Add a row from the cart table (by clone of an hidden template)
*/
function addCartRow(productId) {
    const tbody = document.querySelector("#cart tbody");
    clone = tbody.firstElementChild.cloneNode(true);
    clone.style = "";               // make the row visible
    //set the element id and the product id (dataset)
    clone.id = "product-" + productId;
    clone.dataset.id = productId;
    // product name
    clone.children[0].textContent = "---";
    
    // product unit price
//clone.children[1].firstElementChild.textContent = "0";
    let span = clone.querySelector("#cartUnitPrice-0");
    span.textContent = "0";
    span.id = "cartUnitPrice-" + productId;

    // product quantity
//clone.children[2].children[1].value = "1";
    const input = clone.querySelector("#cartQuantity-0");
    input.value = "1";
//  console.log("Value of row added: " + input.value);
    input.id = "cartQuantity-" + productId;
    
    // product sub total
//clone.children[3].firstElementChild.textContent = "24";
    span = clone.querySelector("#cartSubTotal-0");
    span.textContent = "0";
    span.id = "cartSubTotal-" + productId;

    console.log("Clone children: " + clone.children);
    tbody.appendChild(clone);
}

/* ---------------------------------------------------------------
    Remove a row from the cart table
*/

function removeCartRow(productId) {
//    console.log("Removed row: " + productId);
    const tr = document.querySelector("#product-" + productId);
    tr.remove();
}

function removeAllCartRow() {
    const trs = document.querySelectorAll('[id^="product-"]');
    trs.forEach(tr => {
        console.log(tr);
        productId = tr.dataset.id;
        if (productId != 0) removeCartRow(productId);
    });
}

/* ---------------------------------------------------------------
    Synchronize cart with returned JSON data from the backend
    Return: total amount
*/

function synchronizeCart(jsonCart) {
    
    //console.log(jsonCart.message);
    
    const tbody = document.querySelector("#cart tbody");
 
    let total = 0;
    let subTotal;

    // for each elements of the JSON cart, update the coresponding row of the cart table
    const products = jsonCart.products;

    for (const id in products) {
        let product = products[id];
        //console.log(`${id}: ${product}`);
        const tr = tbody.querySelector("#product-" + id);
        //sync. product name
        tr.firstElementChild.textContent = product.name;

        //sync. unit price
        let element = tbody.querySelector("#cartUnitPrice-" + id);  // this isa <span>
        element.textContent = product.unitPrice;

        //sync. quantity
        element = tbody.querySelector("#cartQuantity-" + id);       // this is a <input type="text">
        element.value = product.quantity;

        //sync. sub total
        element = tbody.querySelector("#cartSubTotal-" + id);       // this is a <span>
        subTotal = product.quantity * product.unitPrice;
        element.textContent = subTotal;

        total += subTotal;
    };

    return (total);
}

function updateTotal (total){
    document.querySelector("#cartTotal").innerHTML = total;
}


/*-----------------------------------------------
 *  Badge management
 *-----------------------------------------------*/

function updateCartBadge(count) {
    const badge = document.querySelector('#badge');
    badge.innerHTML = count;
}


/*-----------------------------------------------
 *  Cart display management (modal) and message area
 *-----------------------------------------------*/

/*------ Cart display -------*/
function showCart(event) {
    cartModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function hideCart(event) {
    cartModal.style.display = "none";
}

function updateCartMessage (jsonObj) {
    let message;
    if (typeof(jsonObj.message) != 'undefined') message = jsonObj.message;
    else message = "";
    
    document.querySelector("#cartMessage").textContent = message;
}


/*-----------------------------------------------
 *  
 *-----------------------------------------------*/

// ouverture et fermeture du panier depuis le menu
function addAllListeners(event) {
    const cartButton = document.querySelector("#cartButton");
    if (cartButton) cartButton.addEventListener("click", showCart);

    // it could be shared among several modal contents
    const close = document.querySelector(".close");
    if (close) close.addEventListener("click", hideCart);

}

document.addEventListener("DOMContentLoaded", addAllListeners);