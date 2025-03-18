import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import RouterWeb from './router/index'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import colors from "vuetify/lib/util/colors";
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import store from './store/store'

import App from './web/Index.vue';

import LoginPage from "./web/Login.vue"
import MainPage from "./web/App.vue"

import HomePage from "./Componentes/Home/Home.vue"

import HeaderComponent from "./Componentes/Header.vue"
import NavbarComponent from "@/Componentes/Navbar.vue";
import HomeLeft from "./Componentes/Home/HomeLeft.vue"
import HomeCenter from "./Componentes/Home/HomeCenter.vue"
import HomeRight from "./Componentes/Home/HomeRight.vue"

axios.interceptors.response.use(
  function (response) {
      return response;
  },
  function (error) {
      if (!!error && !!error.response && !!error.response.status && 401 === error.response.status) {
          app.$store.dispatch("setLogout");
          app.$router.push("/");
      } else {
          return Promise.reject(error);
      }
  }
);

const app = createApp(App);
const vuetify = createVuetify({
  components,
  directives,
  theme: {
    themes: {
      light: {
        dark: false,
        colors: {
          primary: '#654321',
          secondary: colors.grey.darken1,
          footer: colors.grey.darken2,
          accept: colors.lightGreen.lighten2, 
          cancel: "#FF0000",
          disabled: colors.grey.lighten1,
          highlight: colors.grey.lighten2,
          background: colors.grey.lighten3,
        },
      },
    },
  },
})

app.use(RouterWeb);
app.use(vuetify);
app.use(store)

app.component('Login', LoginPage)
app.component('Main', MainPage)
app.component('Home', HomePage)

app.component('Navbar', NavbarComponent)
app.component('Header', HeaderComponent)
app.component('HomeLeft', HomeLeft)
app.component('HomeCenter', HomeCenter)
app.component('HomeRight', HomeRight)

app.mount('#app');