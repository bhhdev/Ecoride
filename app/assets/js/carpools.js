// // console.log("carpools.js chargé");
//     // onstorage = (newValue) => {
//     //     console.log(newValue)
//     //     console.log('RECUPERATION DU RESULTS DS LOCALSTORAGE')
//     //     results = JSON.parse(localStorage.getItem("results") || "[]");
//     //     results && displayAllRides(results);
//     // } 


//     function setStorage(k, v) {
//         const event = document.createEvent('Event');
//         new Event('storageChanged', {bubbles: true, cancelable:true});
//         localStorage.setItem(k, v);
//         document.dispatchEvent(event);
//     }

//     window.addEventListener('storageChanged', (e) => {
//         console.log('storageChanged raised');
//         results = JSON.parse(localStorage.getItem("results") || "[]");
//         results && displayAllRides(results);
//     });

//     // setStorage("date", new Date())

// // console.log(localStorage.getItem('date'))




// document.addEventListener("DOMContentLoaded", () => {

//     console.log("CARRRRPOOOL");

    
//     /* ========= Helpers ========= */
//     const escapeHTML = s => String(s).replace(/[&<>"']/g, m =>
//         ({ "&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#039;" }[m])
//     );
    
//     const displayAllRides = (rides) => {
//         container.innerHTML = rides.map(rideTemplate).join("");
//     };
     
    
//     /* ========= Template identique au HTML de base ========= */
//     function rideTemplate(ride) {
//         return `
//         <div class="ticket-carpool">
//         <div class="carpool-ticket-content d-flex">
        
//         <!-- PHOTO + PSEUDO -->
//         <div class="photo-content text-center">
        
//         <div class="photo-ticket-carpool">
//             <img class="bob-photo" src="${'avatar-images/'+ ride.driver.pseudo.toLowerCase() +".jpg"}">
//         </div>
        
//         <div class="pseudo-note-driver">
//         <p class="p-pseudo text-white">${escapeHTML(ride.driver.pseudo)}</p>
//         <p class="p-note text-white">${escapeHTML(ride.driver.note)}</p>
//         </div>
//         </div>
        
//         <!-- INFOS DU TRAJET -->
//         <div class="infos-ticket-carpool ms-2">
//         <div class="line-1">
//         <p class="p-trajet text-center mb-2">de ${escapeHTML(ride.trip.from)} à ${escapeHTML(ride.trip.to)}</p>
//         </div>
        
//         <div class="line-2 d-flex justify-content-center">
//         <p class="p-date text-center mb-0">le : ${escapeHTML(ride.trip.date)}</p>
//         <p class="p-h-start text-center mb-0">D : ${escapeHTML(ride.trip.timeStart)}</p>
//         <p class="p-h-end text-center mb-0">A : ${escapeHTML(ride.trip.timeEnd)}</p>
//                     </div>

//                     <div class="line-3">
//                         <p class="p-seat-dispo text-center mb-1">${escapeHTML(ride.trip.seatsLeft)} place(s) disponibles</p>
//                     </div>

//                     <div class="line-4">
//                         <p class="p-ride-eco text-center mb-1">
//                             ${ride.trip.eco ? "trajet éco" : "trajet non-éco"}
//                         </p>
//                     </div>

//                     <div class="d-flex justify-content-center">
//                         <button class="button-details text-white text-uppercase mb-1 mt-0">Détails</button>
//                     </div>
//                 </div>

//                 <!-- SÉPARATEUR -->
//                 <div class="separateur-carpool-ticket ms-2"></div>

//                 <!-- PRIX -->
//                 <div class="price-carpool">
//                     <p class="price-label d-block text-center mb-4">prix</p>
//                     <p class="price-number d-block text-center mb-0">${escapeHTML(ride.price.credits)}</p>
//                     <p class="price-credits d-block text-center mb-0">crédits</p>
//                 </div>

//             </div>
//         </div>
//         `;
//     }
// })

// // // ---- DONNÉES FICTIVES ---- //
// // const fakeRides = [
// //     {
// //         departure: "Paris",
// //         arrival: "Caen",
// //         date: "2025-02-01",
// //         hStart: "08:30",
// //         hEnd: "11:15",
// //         seats: 3,
// //         eco: true
// //     },
// //     {
// //         departure: "Caen",
// //         arrival: "Rennes",
// //         date: "2025-02-01",
// //         hStart: "09:00",
// //         hEnd: "11:40",
// //         seats: 1,
// //         eco: false
// //     },
// //     {
// //         departure: "Lyon",
// //         arrival: "Paris",
// //         date: "2025-02-02",
// //         hStart: "14:00",
// //         hEnd: "18:20",
// //         seats: 2,
// //         eco: true
// //     }
// // ];

// // // ---- FONCTION POUR AFFICHER LES TRAJETS ---- //
// // function displayRides(rides) {
// //     const container = document.getElementById("rides-container");
// //     container.innerHTML = "";

// //     if (rides.length === 0) {
// //         container.innerHTML = "<p class='text-center mt-3'>Aucun trajet trouvé</p>";
// //         return;
// //     }

// //     rides.forEach(ride => {
// //         const html = `
// //         <div class="infos-ticket-carpool">
// //             <div class="line-1">
// //                 <p class="p-trajet text-center text-uppercase">de ${ride.departure} à ${ride.arrival}</p>
// //             </div>
// //             <div class="line-2 d-flex">
// //                 <p class="p-date text-center text-uppercase">${ride.date}</p>
// //                 <p class="p-h-start text-center text-uppercase">${ride.hStart}</p>
// //                 <p class="p-h-end text-center text-uppercase">${ride.hEnd}</p>
// //             </div>
// //             <div class="line-3">
// //                 <p class="p-seat-dispo text-center text-uppercase">${ride.seats} place(s) disponibles</p>
// //             </div>
// //             <div class="line-4">
// //                 <p class="p-ride-eco text-center text-uppercase">${ride.eco ? "trajet éco" : "non-éco"}</p>
// //             </div>
// //             <div class="d-flex justify-content-center">
// //                 <button type="button" class="button-details text-uppercase text-white">détails</button>
// //             </div>
// //         </div>
// //         `;
// //         container.insertAdjacentHTML("beforeend", html);
// //     });
// // }

// // // ---- FILTRAGE ---- //
// // function filterRides() {
// //     const departureInput = document.getElementById("departure-location").value.toLowerCase();
// //     const arrivalInput = document.getElementById("arrival-location").value.toLowerCase();
// //     const dateInput = document.getElementById("departure-date").value;

// //     const results = fakeRides.filter(ride => {
// //         return (
// //             (departureInput === "" || ride.departure.toLowerCase().includes(departureInput)) &&
// //             (arrivalInput === "" || ride.arrival.toLowerCase().includes(arrivalInput)) &&
// //             (dateInput === "" || ride.date === dateInput)
// //         );
// //     });

// //     displayRides(results);
// // }

// // // ---- LISTENERS ---- //
// // document.getElementById("departure-location").addEventListener("input", filterRides);
// // document.getElementById("arrival-location").addEventListener("input", filterRides);
// // document.getElementById("departure-date").addEventListener("change", filterRides);

// // // ---- AFFICHER TOUS LES TRAJETS AU DÉBUT ---- //
// // displayRides(fakeRides);
