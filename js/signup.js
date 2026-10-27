document.getElementById("signupForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const messageEl = document.getElementById("signupMessage");

    if (password !== confirmPassword) {
        messageEl.style.display = "block";
        messageEl.style.color = "red";
        messageEl.textContent = "Passwords do not match.";
        return;
    }

    try {
        const response = await fetch(`${API_BASE}/register.php`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ name, email, password, confirmPassword })
        });

        const data = await response.json();

        messageEl.style.display = "block";

        if (data.success) {
            messageEl.style.color = "green";
            messageEl.textContent = data.message;
            setTimeout(() => window.location.href = "login.html", 1000);
        } else {
            messageEl.style.color = "red";
            messageEl.textContent = data.message;
        }
    } catch (err) {
        messageEl.style.display = "block";
        messageEl.style.color = "red";
        messageEl.textContent = "Something went wrong. Please try again.";
        console.error(err);
    }
});
