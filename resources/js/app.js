import './bootstrap';
import '../css/app.css';
import '../css/vendor/fullcalendar/calendar.css';

import { createApp, h } from 'vue';
import { createHead } from '@vueuse/head';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { Inertia } from '@inertiajs/inertia'; // ← für Events
import Chart from 'chart.js/auto';

// Pinia für Stores
import { createPinia } from 'pinia';
import { useConsentStore } from '@/stores/consent'; // Pfad ggf. anpassen

window.Chart = Chart; // So kann deine Komponente im onMounted darauf zugreifen
const appName = import.meta.env.VITE_APP_NAME || 'ANTASUS Infra';
const head = createHead();
const pinia = createPinia();

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob('./Pages/**/*.vue')
    ),
  setup({ el, App, props, plugin }) {
    const vueApp = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(head)
      .use(pinia); // ← Pinia einbinden

    // ConsentStore direkt nach Pinia registrieren
    const consentStore = useConsentStore();
    consentStore.loadFromStorage(); // Diese Methode musst du im Store anlegen (siehe unten)

    // → Initialen Page View tracken
    if (window.gtag) {
      window.gtag('event', 'page_view', {
        page_path: window.location.pathname,
        page_title: document.title,
        // dimension1 entspricht dem Custom Dimension "Service Area"
        dimension1: props.initialPage.props.serviceArea || 'none',
      });
    }

    // → Jede Inertia-Navigation tracken
    Inertia.on('navigate', ({ detail }) => {
      const { page } = detail;
      if (window.gtag) {
        window.gtag('event', 'page_view', {
          page_path: page.url,
          page_title: page.props.zig?.title || document.title,
          dimension1: page.props.serviceArea || 'none',
        });
      }
    });

    return vueApp.mount(el);
  },
  progress: {
    color: '#4B5563',
  },
});
