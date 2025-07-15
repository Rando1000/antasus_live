import { defineStore } from "pinia";

export const useConsentStore = defineStore("consent", {
  state: () => ({
    consentGiven: false,
    consentDate: null,
    categories: {
      essential: true,   // Immer an
      analytics: false,
      marketing: false,
      external: false,
    },
    wasExplicitlySet: false,
    privacyTemporarilyHidden: false,
  }),
  actions: {
    loadFromStorage() {
      const stored = localStorage.getItem("antasus_consent");
      if (stored) {
        const data = JSON.parse(stored);
        this.consentGiven = data.consentGiven ?? false;
        this.consentDate = data.consentDate ?? null;
        this.categories = { ...this.categories, ...(data.categories || {}) };
        this.wasExplicitlySet = data.wasExplicitlySet ?? false;
      }
    },
    setConsentAll(status) {
      this.consentGiven = status;
      this.wasExplicitlySet = true;
      this.consentDate = new Date().toISOString();
      Object.keys(this.categories).forEach((cat) => {
        if (cat !== "essential") this.categories[cat] = status;
      });
      this.saveToStorage();
    },
    setCategory(cat, status) {
      if (cat !== "essential") {
        this.categories[cat] = status;
        this.wasExplicitlySet = true;
        this.consentDate = new Date().toISOString();
        // Mindestens eine Option aktiviert?
        if (
          Object.entries(this.categories).some(
            ([key, val]) => key !== "essential" && val
          )
        ) {
          this.consentGiven = true;
        } else {
          this.consentGiven = false;
        }
        this.saveToStorage();
      }
    },
    // *** Speziell für "Nur Essenzielle": ***
    acceptEssentialsOnly() {
      this.consentGiven = false; // Keine freiwilligen Cookies
      this.wasExplicitlySet = true;
      this.consentDate = new Date().toISOString();
      Object.keys(this.categories).forEach((cat) => {
        this.categories[cat] = cat === "essential";
      });
      this.saveToStorage();
    },
    resetConsent() {
      this.consentGiven = false;
      this.wasExplicitlySet = false;
      this.consentDate = null;
      Object.keys(this.categories).forEach((cat) => {
        this.categories[cat] = cat === "essential";
      });
      this.saveToStorage();
    },
    saveToStorage() {
      localStorage.setItem(
        "antasus_consent",
        JSON.stringify({
          consentGiven: this.consentGiven,
          consentDate: this.consentDate,
          categories: this.categories,
          wasExplicitlySet: this.wasExplicitlySet,
        })
      );
    },
    temporarilyHideOnPrivacy() {
      this.privacyTemporarilyHidden = true;
    },
    clearTemporaryHide() {
      this.privacyTemporarilyHidden = false;
    },
  },
  getters: {
    hasConsent: (state) =>
      state.wasExplicitlySet &&
      (state.consentGiven ||
        Object.keys(state.categories).every(
          (cat) => cat === "essential" || !state.categories[cat]
        )),
    isCategoryAccepted: (state) => (cat) => !!state.categories[cat],
  },
});
