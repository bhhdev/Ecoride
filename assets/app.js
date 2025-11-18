import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

import './vendor/bootstrap/bootstrap.index.js';
import './vendor/bootstrap/dist/css/bootstrap.min.css';

import './styles/app.scss';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');



// =========================
//  TRAJETS FICTIFS
// =========================
const fakeRides = [
    {
        departure: "Caen",
        arrival: "Paris",
        date: "2025-01-12",
        start: "08:30",
        end: "11:45",
        seats: 3,
        eco: true
    },
    {
        departure: "Lyon",
        arrival: "Marseille",
        date: "2025-01-12",
        start: "10:00",
        end: "13:20",
        seats: 1,
        eco: false
    },
    {
        departure: "Bordeaux",
        arrival: "Toulouse",
        date: "2025-01-13",
        start: "09:00",
        end: "11:30",
        seats: 2,
        eco: true
    }
];


// =========================
//  FONCTION : Génère un ticket HTML
// =========================
function createRideTicket(ride) {
    return `
        <div class="infos-ticket-carpool">
            <div class="line-1">
                <p class="p-trajet text-center text-uppercase">de ${ride.departure} à ${ride.arrival}</p>
            </div>
            <div class="line-2 d-flex">
                <p class="p-date text-center text-uppercase">${ride.date}</p>
                <p class="p-h-start text-center text-uppercase">${ride.start}</p>
                <p class="p-h-end text-center text-uppercase">${ride.end}</p>
            </div>
            <div class="line-3">
                <p class="p-seat-dispo text-center text-uppercase">${ride.seats} place(s) disponibles</p>
            </div>
            <div class="line-4">
                <p class="p-ride-eco text-center text-uppercase">${ride.eco ? "trajet éco" : "trajet non-éco"}</p>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="button-details text-uppercase text-white">détails</button>
            </div>
        </div>
    `;
}


// =========================
//  FONCTION : Recherche asynchrone
// =========================
async function searchRides() {
    const departure = document.getElementById("departure-location").value.trim().toLowerCase();
    const arrival = document.getElementById("arrival-location").value.trim().toLowerCase();
    const date = document.getElementById("departure-date").value;

    // Simule un appel async (API future)
    await new Promise(resolve => setTimeout(resolve, 300));

    const results = fakeRides.filter(ride =>
        (departure ? ride.departure.toLowerCase().includes(departure) : true) &&
        (arrival ? ride.arrival.toLowerCase().includes(arrival) : true) &&
        (date ? ride.date === date : true)
    );

    renderResults(results);
}


// =========================
//  FONCTION : Injecte les résultats dans la page
// =========================
function renderResults(rides) {
    const container = document.getElementById("rides-container");

    if (!container) {
        console.error("⚠️ ERREUR : #rides-container est introuvable dans le HTML.");
        return;
    }

    if (rides.length === 0) {
        container.innerHTML = `<p class="text-center mt-4">Aucun trajet trouvé.</p>`;
        return;
    }

    container.innerHTML = rides.map(r => createRideTicket(r)).join("");
}


// =========================
//  ÉCOUTEURS D'ÉVÈNEMENTS
// =========================
document.addEventListener("DOMContentLoaded", () => {
    // Recherche live
    document.getElementById("departure-location").addEventListener("input", searchRides);
    document.getElementById("arrival-location").addEventListener("input", searchRides);
    document.getElementById("departure-date").addEventListener("change", searchRides);

    // Affiche des trajets au chargement
    searchRides();
});
