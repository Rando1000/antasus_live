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

onMounted(async () => {
    const response = await fetch("/admin/visitor-map");
    const visitors = await response.json();

    const map = L.map("visitor-map", {
        center: [51.1657, 10.4515], // Zentrum Deutschland
        zoom: 5,
        zoomControl: false,
        scrollWheelZoom: false,
        dragging: true,
    });

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    visitors.forEach((v) => {
        if (v.latitude && v.longitude) {
            L.circleMarker([v.latitude, v.longitude], {
                radius: 6,
                fillColor: "#00fdcf",
                color: "#00000088",
                weight: 1,
                opacity: 0.8,
                fillOpacity: 0.85,
            })
                .addTo(map)
                .bindPopup(
                    `<div style='font-size:12px'><b>${
                        v.city || "Unbekannt"
                    }</b>, ${v.country || ""}<br><small>${new Date(
                        v.visited_at
                    ).toLocaleString()}</small></div>`
                );
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
