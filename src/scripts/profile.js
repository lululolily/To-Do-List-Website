$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

let photoPopup = document.getElementById("photo-popup");
let usernamePopup = document.getElementById("username-popup");
let emailPopup = document.getElementById("email-popup");
let passwordPopup = document.getElementById("password-popup");

function openPhotoPopup() {
photoPopup.classList.add("open-popup");
document.querySelector(".overlay-pfp").style.display = "block";
}

function closePhotoPopup() {
photoPopup.classList.remove("open-popup");
document.querySelector(".overlay-pfp").style.display = "none";
}

function openUsernamePopup() {
usernamePopup.classList.add("open-popup");
document.querySelector(".overlay-name").style.display = "block";
}

function closeUsernamePopup() {
usernamePopup.classList.remove("open-popup");
document.querySelector(".overlay-name").style.display = "none";
}

function openEmailPopup() {
emailPopup.classList.add("open-popup");
document.querySelector(".overlaymail").style.display = "block";
}

function closeEmailPopup() {
emailPopup.classList.remove("open-popup");
document.querySelector(".overlaymail").style.display = "none";
}

function openPasswordPopup() {
passwordPopup.classList.add("open-popup");
document.querySelector(".overlaypass").style.display = "block";
}

function closePasswordPopup() {
passwordPopup.classList.remove("open-popup");
document.querySelector(".overlaypass").style.display = "none";
}