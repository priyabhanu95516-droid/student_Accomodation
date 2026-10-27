// Search box
document.getElementById("citySearchBtn").addEventListener("click", function () {
    const city = document.getElementById("citySearchInput").value.trim();
    if (city) {
        window.location.href = `properties.php?location=${encodeURIComponent(city)}`;
    } else {
        window.location.href = `properties.php`;
    }
});

document.getElementById("citySearchInput").addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
        document.getElementById("citySearchBtn").click();
    }
});

// City cards
document.querySelectorAll(".city-card").forEach(card => {
    card.style.cursor = "pointer";
    card.addEventListener("click", function () {
        const city = card.getAttribute("data-city");
        window.location.href = `properties.php?location=${encodeURIComponent(city)}`;
    });
});

// Featured properties (first 3 from backend)
async function loadFeaturedProperties() {
    const container = document.getElementById("featuredProperties");

    try {
        const response = await fetch(`${API_BASE}/properties.php`);
        const data = await response.json();

        if (!data.success || data.properties.length === 0) {
            container.innerHTML = "<p>No properties available right now.</p>";
            return;
        }

        const featured = data.properties.slice(0, 3);

        container.innerHTML = featured.map(property => `
            <div class="property-card">
                <img src="${property.image}" alt="${property.name}">
                <h3>${property.name}</h3>
                <p><strong>Location:</strong> ${property.location}</p>
                <p><strong>Price:</strong> ₹${Number(property.rent).toLocaleString('en-IN')} / month</p>
                <p><strong>Rating:</strong> ⭐ ${property.rating}</p>
                <button onclick="window.location.href='property-detail.php?id=${property.id}'">View Details</button>
            </div>
        `).join("");
    } catch (err) {
        container.innerHTML = "<p>Could not load properties. Please try again later.</p>";
        console.error(err);
    }
}

loadFeaturedProperties();
