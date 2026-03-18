document.addEventListener("DOMContentLoaded", function () {

    const vehicleItems = document.querySelectorAll(".vehicle-item");
    const hiddenInput = document.querySelector(".vehicle-hidden-input");

    vehicleItems.forEach(item => {

        item.addEventListener("click", function(){

            /* retire la sélection précédente */
            vehicleItems.forEach(v =>
                v.classList.remove("vehicle-item-selected")
            );

            /* ajoute la sélection */
            this.classList.add("vehicle-item-selected");

            /* met à jour le champ Symfony */
            if(hiddenInput){
                hiddenInput.value = this.dataset.id;
            }

        });

    });

});