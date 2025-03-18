const menuBar = document.querySelector(".menu-bar");
const menuNav = document.querySelector(".menu");

// menuBar.addEventListener("click", () => {
//   menuNav.classList.toggle("show");
// });

const navBar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {
  const windowPosition = window.scrollY > 0;
  navBar.classList.toggle("scrolling-active", windowPosition);
});

// hamburger
const hamburger = document.querySelector(".hamburger");
const menu = document.querySelector(".menu");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("is-active");
  menu.classList.toggle("menu-active");
});

window.addEventListener("scroll", () => {
  hamburger.classList.remove("is-active");
  menu.classList.remove("menu-active");
});

// to login
document.querySelector(".login-button").addEventListener("click", () => {
  window.location.href = "loginpage.html";
});

// to registrasi
document.querySelector(".registrasi-button").addEventListener("click", () => {
  window.location.href = "registrasipage.html";
});
