const loginSection = document.getElementById("login");
let sequence = "";  // stores pressed keys

document.addEventListener("keydown", (e) => {
    sequence += e.key.toLowerCase(); // add key in lowercase

    // check if sequence contains 'al'
    if (sequence.includes("al")) {
        loginSection.style.display = "flex";               // show login
        loginSection.scrollIntoView({ behavior: "smooth" }); // scroll to login
        sequence = ""; // reset sequence
    }

    // keep sequence max length 2 to avoid overflow
    if (sequence.length > 2) {
        sequence = sequence.slice(-2);
    }
});
