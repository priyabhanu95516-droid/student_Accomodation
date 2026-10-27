document.getElementById("loginForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const messageEl = document.getElementById("loginMessage");

    try {
        const response = await fetch(`${API_BASE}/login.php`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            credentials: "include",
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        messageEl.style.display = "block";

        if (data.success) {
            messageEl.style.color = "green";
            messageEl.textContent = data.message;
            localStorage.setItem("user", JSON.stringify(data.user));
            setTimeout(() => window.location.href = "index.php", 800);
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
