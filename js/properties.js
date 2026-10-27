const amenityIcons = {
    "WiFi": "📶",
    "Food": "🍽",
    "Laundry": "🧺",
    "AC": "❄",
    "Parking": "🅿",
    "Gym": "🏋"
};

async function loadProperties() {
    const container = document.getElementById("propertyList");
    const params = new URLSearchParams(window.location.search);
    const location = params.get("location");

    try {
        const url = location
            ? `${API_BASE}/properties.php?location=${encodeURIComponent(location)}`
            : `${API_BASE}/properties.php`;
        const response = await fetch(url);
        const data = await response.json();

        if (!data.success || data.properties.length === 0) {
            container.innerHTML = location
                ? `<p>No properties found in "${location}". <a href="properties.php">View all properties</a></p>`
                : "<p>No properties available right now.</p>";
            return;
        }

        container.innerHTML = data.properties.map(property => `
            <div class="property-card">
                <img src="${property.image}" alt="${property.name}">
                <div class="property-content">
                    <h2>${property.name}</h2>
                    <span class="rating">⭐ ${property.rating}</span>
                    <p class="location">📍 ${property.location}</p>
                    <p class="rent">₹${Number(property.rent).toLocaleString('en-IN')} / Month</p>
                    <div class="amenities">
                        ${property.amenities.map(a => `<span>${amenityIcons[a] || "•"} ${a}</span>`).join("")}
                    </div>
                    <button onclick="window.location.href='property-detail.php?id=${property.id}'">
                        View Details
                    </button>
                </div>
            </div>
        `).join("");
    } catch (err) {
        container.innerHTML = "<p>Could not load properties. Please try again later.</p>";
        console.error(err);
    }
}

loadProperties();
