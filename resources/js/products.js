// ── CHIPS ──
document.querySelectorAll(".chip").forEach((chip) => {
    chip.addEventListener("click", () => {
        const pressed = chip.getAttribute("aria-pressed") === "true";
        chip.setAttribute("aria-pressed", String(!pressed));
        chip.classList.toggle("selected", !pressed);
    });
});
