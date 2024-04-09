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








// Ce code JavaScript est une fonction nommée addProductInCart qui est utilisée 
// pour ajouter un produit au panier dans une application web. Voici une explication ligne par ligne :
// La fonction addProductInCart prend en paramètre l'ID du produit à ajouter au panier.
// La fonction utilise l'API fetch pour effectuer une requête HTTP GET vers une URL. 
// Cette URL est construite avec le paramètre action égal à "cartAdd" et l'ID du produit fourni.
// Les options de la requête fetch comprennent la méthode GET et un en-tête spécifiant que le contenu 
// de la requête est au format JSON.
// Ensuite, une série de promesses (Promise) est enchaînée à l'aide de .then :
// Le premier .then vérifie si la réponse de la requête est OK (statut HTTP 200). Si c'est le cas,
// il retourne le contenu JSON de la réponse.
// Le deuxième .then traite le contenu JSON de la réponse, généralement mis à jour en fonction de 
// l'action de l'utilisateur. Dans ce cas, il met à jour le panier sur l'interface utilisateur en 
// manipulant le DOM, puis met à jour un badge affichant le nombre d'articles dans le panier.
// Si une erreur se produit à n'importe quelle étape de la chaîne de promesses, elle est gérée par 
// le bloc .catch, qui affiche simplement le message d'erreur dans la console.

// En résumé, cette fonction envoie une requête pour ajouter un produit au panier, met à jour 
// l'interface utilisateur en fonction de la réponse serveur et gère les erreurs qui pourraient 
// survenir lors du processus.

/**
 * Ajoute un produit au panier.
 * @param {string} productId - L'identifiant du produit à ajouter au panier.
 */
function addProductInCart(productId) {
    fetch('?action=cartAdd&productId=' + productId,    // URL
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

            //###DEBUG
            console.log(jsonObject);


            // update the badge value
            let badge = document.querySelector(`#cartBadge`);
            //.innerHTML = jsonObject.length;
            //badge.innerHTML = parseInt(badge.innerHTML) + 1;
            badge.innerHTML = Object.keys(jsonObject).length;
        })

        // faire valider mon catch par Thierry
        .catch(error => {
            console.log(error.message);
            window.alert("Une erreur s'est produite lors de l'ajout du produit au panier. Veuillez réessayer plus tard.")
            logErrorOnServer(error);
            if (error instanceof NetworkError) {
                // Désactiver des fonctionnalités spécifiques qui nécessitent une connexion réseau
                disableNetworkDependentFeatures();
            }
        })
}





function updateProductInCart(productId) {
    const quantity = document.querySelector("#item"+productId).value;
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

            //###DEBUG
            console.log(jsonObject);

        })

        // faire valider mon catch par Thierry
        .catch(error => {
            // console.log(error.message);
            window.alert("Une erreur s'est produite lors de l'ajout du produit au panier. Veuillez réessayer plus tard.")
            // logErrorOnServer(error);
            // if (error instanceof NetworkError) {
            //     // Désactiver des fonctionnalités spécifiques qui nécessitent une connexion réseau
            //     disableNetworkDependentFeatures();
            // }
        })
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

