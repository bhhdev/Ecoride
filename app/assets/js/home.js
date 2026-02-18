console.log('home.js loaded');
// Déclare les variables de timer 
let timer1, timer2, timer3, timer4;

const filterAnimation = () => {
    // Déclare les éléments du DOM
    const filter1Paysage = document.querySelector(".filter-1-bg");
    const filter2Paysage = document.querySelector(".filter-2-bg");
    const filter3Paysage = document.querySelector(".filter-3-bg");
    const allFilters = [filter1Paysage, filter2Paysage, filter3Paysage];
    console.log('filters Paysage: ', filter1Paysage, filter2Paysage, filter3Paysage);

    // Etape 0 : Clean les timers
    stopAllTimers()

    // Etape 1 : Affiche les filtres avec la classe "hidden" enlevée
    allFilters.forEach(element => {
        element.classList.remove("hidden"); 
    });

    // Etape 2 : Supprime les filtres au furet et à mesure avec des timers
    timer1 = setTimeout(() => {
        filter3Paysage.classList.add("hidden");
    }, 1000);
    
    timer2 = setTimeout(() => {
        filter2Paysage.classList.add("hidden");
    }, 2000);
    
    timer3 = setTimeout(() => {
        filter1Paysage.classList.add("hidden");
    }, 3000);
    
    // Etape 3 : Relance l'animation toutes les 5 secondes
    timer4 = setTimeout(() => {
        allFilters.forEach(element => {
            element.classList.remove("hidden"); 
        });
        filterAnimation();
    }, 5000);
};

const stopAllTimers = () => {
    clearTimeout(timer1);
    clearTimeout(timer2);
    clearTimeout(timer3);
    clearTimeout(timer4);
};


// Gestion des evénements pour les animations des filtres sur la page d'accueil

// Fonction pour démarrer l'animation lors du chargement de la page
document.addEventListener("DOMContentLoaded", () => {    
    // 1er lancement de l'animation
    filterAnimation();
});

// Relance l'animation à chaque fois que la page est visitée via Turbo
document.addEventListener("turbo:load", () =>
    filterAnimation()
);

// Stoppe les timers avant que la page soit mise en cache par Turbo
document.addEventListener("turbo:before-cache", () =>
    stopAllTimers()
);
