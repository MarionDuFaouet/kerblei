// Fonction pour remplir le formulaire avec les données du produit sélectionné
function fillForm(productId) {
    // Remplir les champs du formulaire avec les données du produit sélectionné
    document.getElementById("selectedProductId").value = productId;
    document.getElementById("productName").value = "<?php echo $product['name']; ?>";
    document.getElementById("productDegre").value = "<?php echo $product['degree']; ?>";
    document.getElementById("productDescription").value = "<?php echo $product['designation']; ?>";
    document.getElementById("productPrice").value = "<?php echo $product['unitPrice']; ?>";
    document.getElementById("productPictureRef").value = "<?php echo $product['pictureRef']; ?>";
}