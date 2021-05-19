import Contacts from "./components/Contacts.vue";
import VueRouter from "vue-router";

const routes = [
        {
            path: "/contacts",
            component: Contacts,
            name: "contacts"
        }
    ],
    router = new VueRouter({
        routes, // short for `routes: routes`
        mode: "history"
    });

export default router;
