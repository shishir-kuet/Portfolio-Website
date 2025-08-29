// Smooth scroll to section
function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  section.scrollIntoView({ behavior: "smooth" });
}

// Change background color randomly
function changeBackgroundColor() {
  const colors = ["#ff9999", "#99ccff", "#99ff99", "#ffcc99", "#cc99ff"];
  const randomColor = colors[Math.floor(Math.random() * colors.length)];
  document.body.style.backgroundColor = randomColor;
}

window.addEventListener("DOMContentLoaded", () => {
  const homepageSection = document.getElementById("one"); // homepage hero section
  const clockContainer = document.getElementById("homepage-clock");

  if (homepageSection) {
    clockContainer.style.display = "block"; // show only on homepage
  } else {
    clockContainer.style.display = "none"; // hide on other pages/sections
  }
});

function updateClock() {
  const clock = document.getElementById("clock");
  const now = new Date();
  clock.textContent = now.toLocaleTimeString();
}

function startClock() {
  updateClock(); // show immediately
  setInterval(updateClock, 1000); // keep updating
}
const sidebar = document.querySelector(".sidebar"); // select your sidebar

window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
        sidebar.style.display = "none"; // hide sidebar after scrolling down
    } else {
        sidebar.style.display = "flex"; // show sidebar at top
    }
});
