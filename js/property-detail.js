const params = new URLSearchParams(window.location.search);
const propertyId = params.get("id") || 1; // fallback to property 1 if no id in URL

const amenityIconMap = {
    "WiFi": "wifi.svg",
    "Food": "dining.svg",
    "Laundry": "washingmachine.svg",
    "AC": "ac.svg",
    "Parking": "parking.svg",
    "Gym": "support.svg"
};

async function loadPropertyDetail() {
    try {
        const response = await fetch(`${API_BASE}/property.php?id=${propertyId}`);
        const data = await response.json();

        if (!data.success) {
            document.getElementById("propertyName").textContent = "Property not found";
            return;
        }

        const p = data.property;

        document.getElementById("breadcrumbName").textContent = p.name;
        document.getElementById("propertyImage").src = p.image;
        document.getElementById("propertyImage").alt = p.name;
        document.getElementById("propertyRating").textContent = `${p.rating} Rating`;
        document.getElementById("propertyName").textContent = p.name;
        document.getElementById("propertyLocation").textContent = `📍 ${p.location}`;
        document.getElementById("propertyRent").textContent = `₹${Number(p.rent).toLocaleString('en-IN')} / Month`;
        document.getElementById("propertyDescription").textContent = p.description;
        document.title = `${p.name} - Property Details`;

        const amenitiesGrid = document.getElementById("amenitiesGrid");
        if (p.amenities && p.amenities.length > 0) {
            amenitiesGrid.innerHTML = p.amenities.map(a => `
                <div class="amenity">
                    <img src="icons/${amenityIconMap[a] || 'support.svg'}" alt="${a}">
                    <span>${a}</span>
                </div>
            `).join("");
        } else {
            amenitiesGrid.innerHTML = "<p>No amenities listed for this property.</p>";
        }

        // Rating summary (derived from this property's actual rating)
        const ratingValue = Number(p.rating);
        const percent = Math.round((ratingValue / 5) * 100);
        const fullStars = Math.round(ratingValue);
        document.getElementById("overallRatingNum").textContent = ratingValue.toFixed(1);
        document.getElementById("overallRatingStars").textContent = "★".repeat(fullStars) + "☆".repeat(5 - fullStars);
        document.getElementById("ratingCleanliness").value = percent;
        document.getElementById("ratingFood").value = percent;
        document.getElementById("ratingSecurity").value = percent;
        document.getElementById("ratingLocation").value = percent;
        document.getElementById("ratingValue").value = percent;

        loadReviews();
        loadSimilarProperties(p.location);
    } catch (err) {
        console.error(err);
    }
}

async function loadReviews() {
    const reviewGrid = document.getElementById("reviewGrid");
    try {
        const response = await fetch(`${API_BASE}/reviews.php?property_id=${propertyId}`);
        const data = await response.json();

        document.getElementById("overallRatingCount").textContent = `${data.reviews.length} Student Reviews`;

        if (!data.success || data.reviews.length === 0) {
            reviewGrid.innerHTML = "<p>No reviews yet for this property.</p>";
            return;
        }

        reviewGrid.innerHTML = data.reviews.map(r => `
            <div class="review-card">
                <h3>${r.reviewer_name}</h3>
                <span>${"⭐".repeat(r.rating)}${"☆".repeat(5 - r.rating)}</span>
                <p>${r.comment}</p>
            </div>
        `).join("");
    } catch (err) {
        reviewGrid.innerHTML = "<p>Could not load reviews.</p>";
        console.error(err);
    }
}

async function loadSimilarProperties(currentLocation) {
    const grid = document.getElementById("similarGrid");
    try {
        const response = await fetch(`${API_BASE}/properties.php`);
        const data = await response.json();

        const others = data.properties.filter(prop => String(prop.id) !== String(propertyId));

        if (others.length === 0) {
            grid.innerHTML = "<p>No other properties available.</p>";
            return;
        }

        grid.innerHTML = others.map(prop => `
            <div class="similar-card">
                <img src="${prop.image}" alt="${prop.name}">
                <h3>${prop.name}</h3>
                <p>📍 ${prop.location}</p>
                <p class="price">₹${Number(prop.rent).toLocaleString('en-IN')} / Month</p>
                <a href="property-detail.php?id=${prop.id}">
                    <button>View Details</button>
                </a>
            </div>
        `).join("");
    } catch (err) {
        grid.innerHTML = "<p>Could not load similar properties.</p>";
        console.error(err);
    }
}

document.getElementById("bookBtn").addEventListener("click", async function () {
    const messageEl = document.getElementById("bookMessage");

    try {
        const response = await fetch(`${API_BASE}/book.php`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            credentials: "include",
            body: JSON.stringify({ propertyId })
        });

        const data = await response.json();

        messageEl.style.display = "block";

        if (data.success) {
            messageEl.style.color = "green";
            messageEl.textContent = data.message;
        } else {
            messageEl.style.color = "red";
            messageEl.textContent = data.message;
            if (response.status === 401) {
                setTimeout(() => window.location.href = "login.html", 1200);
            }
        }
    } catch (err) {
        messageEl.style.display = "block";
        messageEl.style.color = "red";
        messageEl.textContent = "Something went wrong. Please try again.";
        console.error(err);
    }
});

loadPropertyDetail();
