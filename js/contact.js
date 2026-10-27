document.getElementById("contactForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const fullName = document.getElementById("fullName").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const subject = document.getElementById("subject").value.trim();
    const message = document.getElementById("message").value.trim();
    const messageEl = document.getElementById("contactMessage");

    try {
        const response = await fetch(`${API_BASE}/contact.php`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ fullName, email, phone, subject, message })
        });

        const data = await response.json();

        messageEl.style.display = "block";

        if (data.success) {
            messageEl.style.color = "green";
            messageEl.textContent = data.message;
            document.getElementById("contactForm").reset();
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
