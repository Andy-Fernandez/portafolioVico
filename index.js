const navToggle = document.querySelector(".nav-toggle");
const navMenu = document.querySelector(".navbar-nav");
const navLink = document.querySelectorAll(".nav-link");

navToggle.addEventListener("click", () => {
  navMenu.classList.toggle("navbar-nav_visible");
  if (navMenu.classList.contains("navbar-nav_visible")) {
    navToggle.setAttribute("aria-label", "Cerrar menú");
  } else {
    navToggle.setAttribute("aria-label", "Abrir menú");
  }
});

function closeMenu() {
  navMenu.classList.remove("navbar-nav_visible");
  navToggle.setAttribute("aria-label", "Abrir menú");
}

console.log(navLink);
if (navLink) {
  navLink.forEach((n) => n.addEventListener("click", closeMenu));
}

