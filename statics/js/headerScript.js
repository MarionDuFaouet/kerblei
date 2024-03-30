function showSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.width = '250px'; // Définir la largeur du sidebar

// Ajouter un gestionnaire d'événements aux liens de la sidebar pour fermer le sidebar lorsqu'un lien est cliqué
const links = sidebar.querySelectorAll('a');
links.forEach(link => {
    link.addEventListener('click', hideSidebar);
});


}

function hideSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.width = '0'; // Réduire la largeur du sidebar à 0 pour le masquer
}