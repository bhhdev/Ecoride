console.log("carpools.js chargé");

// ---- DONNÉES FICTIVES ---- //
const fakeRides = [
    {
        departure: "Paris",
        arrival: "Caen",
        date: "2025-02-01",
        hStart: "08:30",
        hEnd: "11:15",
        seats: 3,
        eco: true
    },
    {
        departure: "Caen",
        arrival: "Rennes",
        date: "2025-02-01",
        hStart: "09:00",
        hEnd: "11:40",
        seats: 1,
        eco: false
    },
    {
        departure: "Lyon",
        arrival: "Paris",
        date: "2025-02-02",
        hStart: "14:00",
        hEnd: "18:20",
        seats: 2,
        eco: true
    }
];

// ---- FONCTION POUR AFFICHER LES TRAJETS ---- //
function displayRides(rides) {
    const container = document.getElementById("rides-container");
    container.innerHTML = "";

    if (rides.length === 0) {
        container.innerHTML = "<p class='text-center mt-3'>Aucun trajet trouvé</p>";
        return;
    }

    rides.forEach(ride => {
        const html = `
        <div class="infos-ticket-carpool">
            <div class="line-1">
                <p class="p-trajet text-center text-uppercase">de ${ride.departure} à ${ride.arrival}</p>
            </div>
            <div class="line-2 d-flex">
                <p class="p-date text-center text-uppercase">${ride.date}</p>
                <p class="p-h-start text-center text-uppercase">${ride.hStart}</p>
                <p class="p-h-end text-center text-uppercase">${ride.hEnd}</p>
            </div>
            <div class="line-3">
                <p class="p-seat-dispo text-center text-uppercase">${ride.seats} place(s) disponibles</p>
            </div>
            <div class="line-4">
                <p class="p-ride-eco text-center text-uppercase">${ride.eco ? "trajet éco" : "non-éco"}</p>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="button-details text-uppercase text-white">détails</button>
            </div>
        </div>
        `;
        container.insertAdjacentHTML("beforeend", html);
    });
}

// ---- FILTRAGE ---- //
function filterRides() {
    const departureInput = document.getElementById("departure-location").value.toLowerCase();
    const arrivalInput = document.getElementById("arrival-location").value.toLowerCase();
    const dateInput = document.getElementById("departure-date").value;

    const results = fakeRides.filter(ride => {
        return (
            (departureInput === "" || ride.departure.toLowerCase().includes(departureInput)) &&
            (arrivalInput === "" || ride.arrival.toLowerCase().includes(arrivalInput)) &&
            (dateInput === "" || ride.date === dateInput)
        );
    });

    displayRides(results);
}

// ---- LISTENERS ---- //
document.getElementById("departure-location").addEventListener("input", filterRides);
document.getElementById("arrival-location").addEventListener("input", filterRides);
document.getElementById("departure-date").addEventListener("change", filterRides);

// ---- AFFICHER TOUS LES TRAJETS AU DÉBUT ---- //
displayRides(fakeRides);
