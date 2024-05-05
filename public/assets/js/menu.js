/*=============== LINK ACTIVE ===============*/
const linkColor = document.querySelectorAll(".nav__link");

function colorLink() {
  linkColor.forEach((l) => l.classList.remove("active-link"));
  this.classList.add("active-link");
}

linkColor.forEach((l) => l.addEventListener("click", colorLink));

/*=============== SHOW HIDDEN MENU ===============*/
const showMenu = (toggleId, navbarId) => {
  const toggle = document.getElementById(toggleId),
    navbar = document.getElementById(navbarId);

  if (toggle && navbar) {
    toggle.addEventListener("click", () => {
      /* Show menu */
      navbar.classList.toggle("show-menu");
      /* Rotate toggle icon */
      toggle.classList.toggle("rotate-icon");
    });
  }
};
showMenu("nav-toggle", "nav");

/*=============== DARK LIGHT MODE ===============*/
const themeButton = document.getElementById("theme-button");
const darkTheme = "dark-theme";
const iconTheme = "bx-sun";

const selectedTheme = localStorage.getItem("selected-theme");
const selectedIcon = localStorage.getItem("selected-icon");

const getCurrentTheme = () =>
  document.body.classList.contains(darkTheme) ? "dark" : "light";
const getCurrentIcon = () =>
  themeButton.classList.contains(iconTheme) ? "bx bx-moon" : "bx bx-sun";

if (selectedTheme) {
  document.body.classList[selectedTheme === "dark" ? "add" : "remove"](
    darkTheme
  );
  themeButton.classList[selectedIcon === "bx bx-moon" ? "add" : "remove"](
    iconTheme
  );
}

themeButton.addEventListener("click", () => {
  document.body.classList.toggle(darkTheme);
  themeButton.classList.toggle(iconTheme);

  localStorage.setItem("selected-theme", getCurrentTheme());
  localStorage.setItem("selected-icon", getCurrentIcon());
});
