import { routesMocks } from './mocks/routes-mocks.js';
document.addEventListener("DOMContentLoaded", () => {


    const container = document.getElementById("tickets-container");

    /* ========= FAKE DATA (nouveau format) ========= */
    // const routesMocks = [
    //     {
    //         driver: { pseudo: "Maxime", note: 4.8, photo: "/images/bob.jpg" },
    //         trip: { from: "Paris", to: "Amiens", date: "2025-12-04", timeStart: "08:10", timeEnd: "09:40", seatsLeft: 3, eco: true },
    //         price: { credits: 180 }
    //     },
    //     {
    //         driver: { pseudo: "Claire", note: 4.2, photo: "/images/bob.jpg" },
    //         trip: { from: "Caen", to: "Rennes", date: "2025-12-05", timeStart: "09:00", timeEnd: "11:00", seatsLeft: 1, eco: false },
    //         price: { credits: 140 }
    //     }
    // ];

    /* ========= Helpers ========= */
    const escapeHTML = s => String(s).replace(/[&<>"']/g, m =>
        ({ "&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#039;" }[m])
    );

    if (!container) {
        console.error("❌ ERREUR : #tickets-container est introuvable.");
        return;
    }
    
    
    const displayAllRides = (rides) => {
        // rides.map(ride => rideTemplate(ride));
        container.innerHTML = rides.map(rideTemplate).join("");
    };

    
    /* ========= Template identique à ton HTML ========= */
    function rideTemplate(ride) {
        return `
        <div class="ticket-carpool">
        <div class="carpool-ticket-content d-flex">
        
        <!-- PHOTO + PSEUDO -->
        <div class="photo-content text-center">
        
        <div class="photo-ticket-carpool">
            <img class="bob-photo" src="${'avatar-images/'+ ride.driver.pseudo.toString().toLowerCase() +".jpg"}">
        </div>
        
        <div class="pseudo-note-driver">
        <p class="p-pseudo text-white">${escapeHTML(ride.driver.pseudo)}</p>
        <p class="p-note text-white">${escapeHTML(ride.driver.note)}</p>
        </div>
        </div>
        
        <!-- INFOS DU TRAJET -->
        <div class="infos-ticket-carpool ms-2">
        <div class="line-1">
        <p class="p-trajet text-center mb-2">de ${escapeHTML(ride.trip.from)} à ${escapeHTML(ride.trip.to)}</p>
        </div>
        
        <div class="line-2 d-flex justify-content-center">
        <p class="p-date text-center mb-0">le : ${escapeHTML(ride.trip.date)}</p>
        <p class="p-h-start text-center mb-0">D : ${escapeHTML(ride.trip.timeStart)}</p>
        <p class="p-h-end text-center mb-0">A : ${escapeHTML(ride.trip.timeEnd)}</p>
                    </div>

                    <div class="line-3">
                        <p class="p-seat-dispo text-center mb-1">${escapeHTML(ride.trip.seatsLeft)} place(s) disponibles</p>
                    </div>

                    <div class="line-4">
                        <p class="p-ride-eco text-center mb-1">
                            ${ride.trip.eco ? "trajet éco" : "trajet non-éco"}
                        </p>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="button-details text-white text-uppercase mb-1 mt-0">Détails</button>
                    </div>
                </div>

                <!-- SÉPARATEUR -->
                <div class="separateur-carpool-ticket ms-2"></div>

                <!-- PRIX -->
                <div class="price-carpool">
                    <p class="price-label d-block text-center mb-4">prix</p>
                    <p class="price-number d-block text-center mb-0">${escapeHTML(ride.price.credits)}</p>
                    <p class="price-credits d-block text-center mb-0">crédits</p>
                </div>

            </div>
        </div>
        `;
    }

    /* ========= Render ========= */
    // function renderRides(list) {
    //     container.innerHTML = list.map(rideTemplate).join("");
    // }

    // /* Auto-render pour tests */
    // renderRides(routesMocks);




    // ---- FILTRAGE ---- //
    function filterRides(e) {
        e.preventDefault();
        
        const departureInput = document.getElementById("departure-location").value.toLowerCase();
        const arrivalInput = document.getElementById("arrival-location").value.toLowerCase();
        const dateInput = document.getElementById("departure-date").value;

        console.log('Inside filterRides() :',{departureInput,arrivalInput,dateInput});
        const results = routesMocks.filter(ride => {
            console.log(ride.trip.date === dateInput)
            console.log('ride.trip.to',ride.trip.to)
            console.log('arrivalInput',arrivalInput)
            console.log(ride.trip.to.toLowerCase().includes(arrivalInput))
            console.log(ride.trip.to.toLowerCase() === arrivalInput)
            return (
                (departureInput === "" || ride.trip.from.toLowerCase().includes(departureInput)) &&
                (arrivalInput === "" || ride.trip.to.toLowerCase().includes(arrivalInput)) &&
                (dateInput === "" || ride.trip.date === dateInput)
            );
        });
        console.log('results :', results)

        displayAllRides(results); 
    }

    // ---- LISTENERS ---- //
    document.getElementById("departure-location").addEventListener("input", filterRides);
    document.getElementById("arrival-location").addEventListener("input", filterRides);
    document.getElementById("departure-date").addEventListener("change", filterRides);

    // ---- AFFICHER TOUS LES TRAJETS AU DÉBUT ---- //
    


    // displayAllRides(fakeRides);

});