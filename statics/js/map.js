document.addEventListener("DOMContentLoaded", (event) => {
    //console.log("DOM fully loaded and parsed");

    const map = L.map('myMap').setView([47.62018, -2.88567], 12);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([47.62018, -2.88567]).addTo(map)
        .bindPopup('Brasserie Kerblei<br>5 rue de kernavalo<br>56870 BADEN')
        .openPopup();
});