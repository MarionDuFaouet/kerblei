// Fonction pour remplir le formulaire avec les données du produit sélectionné
function fillForm(productId, name, degree, designation, unitPrice, pictureRef) {
    // Remplir les champs du formulaire avec les données du produit sélectionné
    document.getElementById("selectedProductId").value = productId;
    document.getElementById("productName").value = name;
    document.getElementById("productDegre").value = degree;
    document.getElementById("productDescription").value = designation;
    document.getElementById("productPrice").value = unitPrice;
    document.getElementById("productPictureRef").value = pictureRef;
}