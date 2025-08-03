<template>
    <div
        class="w-full h-[400px] rounded-xl border shadow overflow-hidden dark:border-gray-800"
    >
        <div id="visitor-map" class="w-full h-full"></div>
    </div>
</template>

<script setup>
import { onMounted } from "vue";
import L from "leaflet";
import "leaflet/dist/leaflet.css";

// Hilfsfunktion: Unicode-Flagge basierend auf Ländercode
function getFlagEmoji(countryName) {
    const map = {
        Germany: "DE",
        "United States": "US",
        France: "FR",
        Austria: "AT",
        Netherlands: "NL",
        Switzerland: "CH",
        "United Kingdom": "GB",
        Spain: "ES",
        Italy: "IT",
        Belgium: "BE",
        Poland: "PL",
        Denmark: "DK",
        Sweden: "SE",
        Norway: "NO",
        Finland: "FI",
        "Czech Republic": "CZ",
        Slovakia: "SK",
        Hungary: "HU",
        Ireland: "IE",
        Portugal: "PT",
        // ✏️ Ergänze bei Bedarf weitere Länder
    };

    const iso = map[countryName];
    if (!iso || iso.length !== 2) return "🏳️";
    const A = 0x1f1e6;
    const offset = (c) => c.charCodeAt(0) - 65;
    return String.fromCodePoint(A + offset(iso[0]), A + offset(iso[1]));
}

onMounted(async () => {
    const response = await fetch("/admin/visitor-map");
    const visitors = await response.json();

    const map = L.map("visitor-map", {
        center: [51.1657, 10.4515],
        zoom: 5,
        zoomControl: false,
        scrollWheelZoom: false,
        dragging: true,
    });

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    const group = L.layerGroup().addTo(map);

    visitors.forEach((v) => {
        if (v.latitude && v.longitude) {
            const country = v.country || "Unbekannt";
            const city = v.city || "–";
            const flag = getFlagEmoji(country);

            const popupContent = `
                <div style="font-size:13px; line-height:1.4">
                    ${flag} <strong>${city}</strong>, ${country}<br>
                    <span style="font-size:11px; color:#666">${new Date(
                        v.visited_at
                    ).toLocaleString()}</span>
                </div>
            `;

            L.circleMarker([v.latitude, v.longitude], {
                radius: 6,
                fillColor: "#00fdcf",
                color: "#00000088",
                weight: 1,
                opacity: 0.8,
                fillOpacity: 0.85,
            })
                .addTo(group)
                .bindPopup(popupContent);
        }
    });
});
</script>

<style scoped>
#visitor-map {
    height: 100%;
    width: 100%;
    border-radius: 0.75rem;
}
</style>
