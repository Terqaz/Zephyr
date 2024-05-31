import { createApp } from "vue";
// import router from "./router";

import './styles/app.css'

import App from "./components/App.vue";

const vm = createApp(App);
// vm.use(router);
vm.mount('#app');