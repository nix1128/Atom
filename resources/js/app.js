import router from "./routes";
import VueRouter from "vue-router";
import Vue from "vue";
import Index from "./components/index.vue";

import VeeValidate from 'vee-validate';


let axios = require('axios');
 require("./bootstrap");

window.Vue = require("vue").default;
Vue.use(VeeValidate);
Vue.use(VueRouter);

const app = new Vue({
    el: "#app",
    router,
    components: {
        index: Index,

    },


});
