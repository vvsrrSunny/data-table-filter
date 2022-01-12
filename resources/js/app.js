import "../css/app.css";

import "./bootstrap";

import { createApp, defineAsyncComponent } from "vue";


var app = createApp({
    data() {
        return {
            isSetupSuccess: "grand success",
        };
    },
});

// Registering a global component
app.component(
    "DashboardPage",
    defineAsyncComponent(() => import("./components/pages/DashboardPage.vue"))
);

window.app = app.mount("#app");
