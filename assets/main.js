import { createApp } from 'vue'

import './assets/main.css'

import App from './App'
import router from './router'
// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css'

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: 'light'
      },
  })

const app = createApp(App);

app.use(router).use(vuetify,{iconfont: 'mdi'});

app.mount('#app');


// import { createApp } from "vue";
// // import router from "./router";

// import './styles/app.css'

// import App from "./components/App.vue";

// const vm = createApp(App);
// // vm.use(router);
// vm.mount('#app');