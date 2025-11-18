document.addEventListener("DOMContentLoaded", () => {
    const lines = document.querySelectorAll(".intro-line");

    lines.forEach((line, index) => {
        setTimeout(() => {
            line.classList.add("visible");
        }, index * 1000); // 600 ms entre chaque ligne (modifiable)
    });
});