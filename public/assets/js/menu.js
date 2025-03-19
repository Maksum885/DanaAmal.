var li_items = document.querySelectorAll(".sidebar ul li");
var hamburger = document.querySelector(".hamburger");
var wrapper = document.querySelector(".wrapper");

li_items.forEach((li_item) => {
    li_item.addEventListener("mouseenter", () => {
        //  li_item.closest(".wrapper").classList.remove("hover-collapse");
        if (wrapper.classList.contains("click-collapse")) {
            return;
        } else {
            li_item.closest(".wrapper").classList.remove("hover-collapse");
        }
    });
});
li_items.forEach((li_item) => {
    li_item.addEventListener("mouseleave", () => {
        // li_item.closest(".wrapper").classList.add("hover-collapse");
        if (wrapper.classList.contains("click-collapse")) {
            return;
        } else {
            li_item.closest(".wrapper").classList.add("hover-collapse");
        }
    });
});

hamburger.addEventListener("click", () => {
    hamburger.closest(".wrapper").classList.toggle("click-collapse");
    hamburger.closest(".wrapper").classList.toggle("hover-collapse");
});

// submenu profile
let subMenu = document.getElementById("subMenu");

function toggleMenu() {
    subMenu.classList.toggle("open-menu");
}

//  tombol keluar
let exitButton = document.getElementById("exitButton");
exitButton.addEventListener("click", () => {
    window.location.href = "landingpage.php";
});

document.getElementById("menuProfil").addEventListener("click", function () {
    var profilDonatur = document.getElementById("profilDonatur");
    var pengaturan = document.getElementById("pengaturan");
    if (
        profilDonatur.style.display === "none" ||
        profilDonatur.style.display === ""
    ) {
        profilDonatur.style.display = "block"; // Tampilkan bagian profil
        pengaturan.style.display = "none";
    } else {
        profilDonatur.style.display = "none"; // Sembunyikan jika sudah ditampilkan
    }
});
document
    .getElementById("menuPengaturan")
    .addEventListener("click", function () {
        var profilDonatur = document.getElementById("profilDonatur");
        var pengaturan = document.getElementById("pengaturan");

        if (
            pengaturan.style.display === "none" ||
            pengaturan.style.display === ""
        ) {
            pengaturan.style.display = "block"; // Tampilkan bagian profil
            profilDonatur.style.display = "none";
        } else {
            pengaturan.style.display = "none"; // Sembunyikan jika sudah ditampilkan
        }
    });
// beranda
let list = document.querySelector(".slider .list");
let items = document.querySelectorAll(".slider .list .item");
let dots = document.querySelectorAll(".slider .dots li");
let prev = document.querySelector("#prev");
let next = document.querySelector("#next");

let active = 0;
let lengthItems = items.length - 1;

next.onclick = function () {
    if (active + 1 > lengthItems) {
        active = 0;
    } else {
        active = active + 1;
    }
    reloadSlider();
};

prev.onclick = function () {
    if (active - 1 < 0) {
        active = lengthItems;
    } else {
        active = active - 1;
    }
    reloadSlider();
};

let refreshSlider = setInterval(() => {
    next.onclick();
}, 5000);

function reloadSlider() {
    let checkLeft = items[active].offsetLeft;
    list.style.left = -checkLeft + "px";

    let lastActiveDot = document.querySelector(".slider .dots li.active");
    if (lastActiveDot) lastActiveDot.classList.remove("active");
    dots[active].classList.add("active");

    clearInterval(refreshSlider);
    refreshSlider = setInterval(() => {
        next.onclick();
    }, 5000);
}

dots.forEach((li, key) => {
    li.addEventListener("click", function () {
        active = key;
        reloadSlider();
    });
});

function showSection(sectionId) {
    // Ambil semua elemen dengan class "section"
    const sections = document.querySelectorAll(".section");

    // Sembunyikan semua section
    sections.forEach((section) => {
        section.classList.add("hidden");
    });

    // Tampilkan section yang sesuai dengan ID yang dipilih
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.classList.remove("hidden");
    }
}
