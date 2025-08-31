const loginSection = document.getElementById("login");
let sequence = "";

document.addEventListener("keydown", (e) => {
    sequence += e.key.toLowerCase();
    
    if (sequence.includes("al")) {
        // Check session first
        fetch('check_session.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'valid') {
                    // Session exists, redirect to admin
                    window.location.href = data.redirect;
                } else {
                    // No valid session, show login form
                    loginSection.style.display = "flex";
                    loginSection.scrollIntoView({ behavior: "smooth" });
                }
            })
            .catch(error => {
                console.error('Session check failed:', error);
                // Fallback: show login form
                loginSection.style.display = "flex";
                loginSection.scrollIntoView({ behavior: "smooth" });
            });
        
        sequence = ""; // reset sequence
    }
    
    if (sequence.length > 2) {
        sequence = sequence.slice(-2);
    }
});