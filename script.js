// Smooth scroll to section
function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  if (section) {
    section.scrollIntoView({ behavior: "smooth" });
  }
}


function changeBackgroundColor() {
  const colors = ["#ff9999", "#99ccff", "#99ff99", "#ffcc99", "#cc99ff"];
  const randomColor = colors[Math.floor(Math.random() * colors.length)];
  document.body.style.backgroundColor = randomColor;
}

function getUrlParameter(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  const results = regex.exec(location.search);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// Clock update functions
function updateClock() {
  const clock = document.getElementById("clock");
  if (clock) {
    const now = new Date();
    clock.textContent = now.toLocaleTimeString();
  }
}

function startClock() {
  updateClock(); 
  setInterval(updateClock, 1000); 
}

// DOMContentLoaded handler
window.addEventListener("DOMContentLoaded", () => {
  // Show clock container if homepage section exists
  const homepageSection = document.getElementById("one");
  const clockContainer = document.querySelector(".clock-container");
  if (homepageSection && clockContainer) {
    clockContainer.style.display = "block";
  } else if (clockContainer) {
    clockContainer.style.display = "none";
  }

  // Handle contact form submission
  const form = document.getElementById("contactForm");
  if (form) {
    const submitBtn = form.querySelector('button[type="submit"]');
    form.addEventListener("submit", function (e) {
       e.preventDefault();
      if (submitBtn) {
        submitBtn.textContent = "Sending...";
        submitBtn.disabled = true;
      }
            setTimeout(() => {
        form.submit(); // actually submit the form
      }, 1000); 
    });


    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status && submitBtn) {
      if (status === 'success') {
        submitBtn.textContent = "Message Sent";
        submitBtn.style.backgroundColor = "#4CAF50";
        submitBtn.style.color = "white";
        submitBtn.disabled = true;
        form.reset();
      } else if (status === 'error') {
        submitBtn.textContent = "Error";
        submitBtn.style.backgroundColor = "#f44336";
        submitBtn.style.color = "white";
        submitBtn.disabled = true;
      }

      // Reset button after 2 seconds
      setTimeout(() => {
        submitBtn.textContent = "Send Message";
        submitBtn.style.backgroundColor = "";
        submitBtn.style.color = "";
        submitBtn.disabled = false;

        // Remove status from URL
        const newUrl = window.location.pathname + window.location.hash;
        window.history.replaceState({}, document.title, newUrl);
      }, 1000);
    }
  }
});
