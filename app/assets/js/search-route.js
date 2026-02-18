document.addEventListener("DOMContentLoaded", () => {

    const container = document.getElementById("tickets-container");

    const escapeHTML = s => String(s).replace(/[&<>"']/g, m =>
        ({ "&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#039;" }[m])
    );

    if (!container) {
        console.error("ERREUR : #tickets-container est introuvable.");
        return;
    }

    container.innerHTML = "";

    const displayAllRides = (rides) => {
        const visibleRides = rides.filter(ride => 
            ride.trip.status !== 'cancelled' && ride.trip.seatsLeft > 0
        );

        if (visibleRides.length === 0) {
            container.innerHTML = "<p class='text-center'>Aucun trajet trouvé</p>";
        } else {
            container.innerHTML = visibleRides.map(rideTemplate).join("");
        }
    };

    function rideTemplate(ride) {
        console.log(ride.driver.avatar);

        const displayName = ride.driver.displayName ?? "Conducteur";

        // ✅ AVATAR DIRECTEMENT DE LA BDD (pas de default)
        const avatar = `${ride.driver.avatar}`;

        return `
        <div class="ticket-carpool">
            <div class="carpool-ticket-content d-flex">

                <div class="photo-content text-center">
                    <div class="photo-ticket-carpool">
                        <img class="bob-photo"
                            src="${avatar}"
                            alt="Avatar de ${escapeHTML(displayName)}">
                    </div>

                    <div class="pseudo-note-driver text-left">
                        <p class="p-pseudo text-white">${escapeHTML(ride.driver.firstname)}</p>
                        <p class="p-pseudo text-white">${escapeHTML(ride.driver.lastname)}</p>
                        <p class="p-note text-white">${escapeHTML(ride.driver.note ?? "")}</p>
                    </div>
                </div>

                <div class="infos-ticket-carpool ms-2">
                    <div class="line-1">
                        <p class="p-trajet text-center mb-2">
                            de ${escapeHTML(ride.trip.from)} à ${escapeHTML(ride.trip.to)}
                        </p>
                    </div>

                    <div class="line-2 d-flex justify-content-evenly">
                        <p class="mb-0">${escapeHTML(ride.trip.date)}</p>
                        <p class="mb-0">D : ${escapeHTML(ride.trip.timeStart)}</p>
                        <p class="mb-0">A : ${escapeHTML(ride.trip.timeEnd ?? "")}</p>
                    </div>

                    <div class="line-3">
                        <p class="p-seat-dispo text-center mb-1">
                            ${escapeHTML(ride.trip.seatsLeft)} place(s) disponibles
                        </p>
                    </div>

                    <div class="line-4">
                        <p class="p-ride-eco text-center mb-1">
                            ${ride.trip.eco ? "trajet éco" : "trajet non-éco"}
                        </p>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="button-details text-white text-uppercase mb-1 mt-0">
                            Détails
                        </button>
                    </div>
                </div>

                <div class="separateur-carpool-ticket ms-2"></div>

                <div class="price-carpool">
                    <p class="price-label text-center mb-4">prix</p>
                    <p class="price-number text-center mb-0">
                        ${escapeHTML(ride.price.credits)}
                    </p>
                    <p class="price-credits text-center mb-0 fs-6">crédits</p>
                </div>

            </div>
        </div>
        `;
    }

    async function filterRides() {
        const departureInput = document.getElementById("departure-location").value.trim();
        const arrivalInput = document.getElementById("arrival-location").value.trim();
        const dateInput = document.getElementById("departure-date").value.trim();

        if (!departureInput && !arrivalInput && !dateInput) {
            container.innerHTML = "";
            return;
        }

        const params = new URLSearchParams({
            departure: departureInput,
            arrival: arrivalInput,
            date: dateInput
        });

        try {
            const response = await fetch(`/trip-search?${params.toString()}`);
            const rides = await response.json();
            displayAllRides(rides); 
        } catch (error) {
            console.error(error);
        }
    }

    document.getElementById("departure-location").addEventListener("input", filterRides);
    document.getElementById("arrival-location").addEventListener("input", filterRides);
    document.getElementById("departure-date").addEventListener("change", filterRides);

});
