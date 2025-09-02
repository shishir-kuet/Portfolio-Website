const loginSection = document.getElementById("login");
let sequence = "";

document.addEventListener("keydown", (e) => {
    sequence += e.key.toLowerCase();
    
    if (sequence.includes("al")) {
        
        fetch('check_session.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'valid') {
                    window.location.href = data.redirect;
                } else {
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
        
        sequence = ""; 
    }
    
    if (sequence.length > 2) {
        sequence = sequence.slice(-2);
    }
});