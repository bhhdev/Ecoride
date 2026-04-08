document.addEventListener("DOMContentLoaded", () => {

    const container = document.getElementById("tickets-container");

    // Récupération du nombre de crédits de l'utilisateur et de son statut de connexion
    let userCredits = parseInt(window.userCredits ?? 0);
    const isLoggedIn = Boolean(window.isLoggedIn);

    // Fonction d'échappement pour éviter les problèmes de sécurité XSS
    const escapeHTML = s => String(s).replace(/[&<>"']/g, m =>
        ({ "&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#039;" }[m])
    );

    // Fonction pour afficher une notification toast
    function showToast(message, duration = 4000) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = 'toast-message';
        toast.textContent = message;

        container.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.addEventListener('transitionend', () => {
            toast.remove(); // Supprime l'élément avec précision
        }, { once: true })}
        , duration);
    }

    if (!container) {
        console.error("ERREUR : #tickets-container est introuvable.");
        return;
    }

    container.innerHTML = "";

    // Affiche tous les trajets initiaux (non filtrés)
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

    // Fonction pour générer le HTML d'un trajet
    function rideTemplate(ride) {
        const displayName = ride.driver.displayName ?? "Conducteur";
        const avatar = `${ride.driver.avatar}`;
        const priceCredits = parseInt(ride.price.credits);

        return `
        <div class="ticket-carpool" data-id="${ride.id}">
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
                        <p class="mb-0 ms-2">${escapeHTML(ride.trip.date)}</p>
                        <p class="mb-0">D : ${escapeHTML(ride.trip.departureHour)}</p>
                        <p class="mb-0">A : ${escapeHTML(ride.trip.arrivalHour ?? "")}</p>
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
                        <button class="button-details text-white text-uppercase mb-1 mt-0"
                                data-ride='${JSON.stringify(ride)}'>
                            Détails
                        </button>
                    </div>
                </div>

                <div class="separateur-carpool-ticket ms-2"></div>

                <div class="price-carpool">
                    <p class="price-label text-center mb-4">prix</p>
                    <p class="price-number text-center mb-0">
                        ${priceCredits}
                    </p>
                    <p class="price-credits text-center mb-0 fs-6">crédits</p>
                </div>

            </div>
        </div>
        `;
    }

    // Écouteur d'événements pour les clics sur les boutons "Détails" et "Participer"
    document.addEventListener("click", async (e) => {

        if (e.target.classList.contains("button-details")) {

            const ride = JSON.parse(e.target.dataset.ride);

            document.querySelector(".p-pseudo-details").textContent =
                ride.driver.firstname + " " + ride.driver.lastname;

            document.querySelector(".p-note-details").textContent =
                ride.driver.note ?? "";

            document.querySelector(".p-trajet_details").textContent =
                `de ${ride.trip.from} à ${ride.trip.to}`;

            document.querySelectorAll(".p-date_h-start_h-end")[0].innerHTML =
                `le:<br>${ride.trip.date}`;

            document.querySelectorAll(".p-date_h-start_h-end")[1].innerHTML =
                `Départ:<br>${ride.trip.departureHour}`;

            document.querySelectorAll(".p-date_h-start_h-end")[2].innerHTML =
                `Arrivée:<br>${ride.trip.arrivalHour ?? ""}`;

            document.querySelector(".p-seat-dispo_details").textContent =
                `${ride.trip.seatsLeft} place(s) dispo`;

            document.querySelector(".button-participer").dataset.ride =
                JSON.stringify(ride);

            document.querySelector(".details-container").style.display = "block";

            document.querySelector(".details-container").scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        }

        if (e.target.classList.contains("button-participer")) {
            console.log('Button participate clicked !!!!')

            // Vérification de la connexion de l'utilisateur
            if (!isLoggedIn) {
                showToast("❌ Veuillez vous connecter pour réserver", 5000);
                return;
            }

            const rideData = e.target.dataset.ride;

            // Vérification de la présence des données du trajet
            if (!rideData) {
                showToast("❌ Erreur : trajet introuvable", 5000);
                return;
            }

            const ride = JSON.parse(rideData);
            const price = parseInt(ride.price.credits);

            // Vérification du solde de l'utilisateur
            if (userCredits < price) {
                showToast("❌ Solde insuffisant", 5000);
                return;
            }

            // Envoi de la requête de réservation
            try {
                const res = await fetch('/booking/create', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ tripId: ride.trip.id })
                });

                if (!res.ok) throw new Error("Erreur serveur");

                // Tentative de lecture de la réponse JSON, avec gestion des erreurs
                let data = {};
                try {
                    data = await res.json();
                } catch (e) {
                    console.warn("Réponse non JSON");
                }

                if (data.error) {
                    showToast("❌ " + data.error, 5000);
                    return;
                }

                userCredits -= price;

                const creditDisplay = document.querySelector('.text-personal-credits-2_ps');
                if (creditDisplay) {
                    creditDisplay.textContent = `${userCredits} crédit(s)`;
                }

                ride.trip.seatsLeft -= 1;

                // Mise à jour de l'affichage du nombre de places disponibles dans les détails du trajet
                document.querySelector(".p-seat-dispo_details").textContent =
                    `${ride.trip.seatsLeft} place(s) dispo`;

                // Mise à jour de l'affichage du nombre de places disponibles sur la carte du trajet
                document.querySelectorAll(".ticket-carpool").forEach(card => {
                    if (card.innerHTML.includes(ride.trip.from) &&
                        card.innerHTML.includes(ride.trip.to)) {

                        const seatEl = card.querySelector(".p-seat-dispo");
                        if (seatEl) {
                            seatEl.textContent = `${ride.trip.seatsLeft} place(s) disponibles`;
                        }
                    }
                });

                // Stockage du trajet réservé dans le localStorage pour la page de confirmation
                localStorage.setItem("nextPassengerRide", JSON.stringify(ride));

                showToast("✅ Bravo vous avez réservé votre trajet !");
            } catch (error) {
                console.error(error);
                showToast("❌ Erreur lors de la réservation", 5000);
            }
        }
    });

    // Fonction pour filtrer les trajets en fonction des critères de recherche
    async function filterRides() {
        const departureInput = document.getElementById("departure-location").value.trim();
        const arrivalInput = document.getElementById("arrival-location").value.trim();
        const dateInput = document.getElementById("departure-date").value.trim();

        if (!departureInput && !arrivalInput && !dateInput) {
            container.innerHTML = "";
            return;
        }

        // Construction des paramètres de recherche
        const params = new URLSearchParams({
            departure: departureInput,
            arrival: arrivalInput,
            date: dateInput
        });

        // Envoi de la requête de recherche au serveur
        try {
            const response = await fetch(`/trip-search?${params.toString()}`);
            const rides = await response.json();
            displayAllRides(rides); 
        } catch (error) {
            console.error(error);
        }
    }

    // Écouteurs d'événements pour les champs de recherche
    document.getElementById("departure-location").addEventListener("input", filterRides);
    document.getElementById("arrival-location").addEventListener("input", filterRides);
    document.getElementById("departure-date").addEventListener("change", filterRides);

});