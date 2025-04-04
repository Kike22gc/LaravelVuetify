import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import RouterWeb from './router/index'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import store from './store/store'
import { VDateInput } from 'vuetify/labs/VDateInput'

import App from './web/Index.vue';

import LoginPage from "./web/Login.vue"
import RegistroPage from "./web/Registro.vue"
import MainPage from "./web/App.vue"

import HeaderComponent from "./Componentes/Header.vue"
import NavbarComponent from "@/Componentes/Navbar.vue";

import HomeLeft from "./Componentes/Home/HomeLeft.vue"
import HomeCenter from "./Componentes/Home/HomeCenter.vue"
import HomeRight from "./Componentes/Home/HomeRight.vue"

import CrearEditarProyecto from "./Componentes/Proyectos/CrearEditar/Main.vue"
import ProyectoGeneral from "./Componentes/Proyectos/CrearEditar/General.vue"
import ProyectoDesarrollo from "./Componentes/Proyectos/CrearEditar/Desarrollo.vue"
import ProyectoStock from "./Componentes/Proyectos/CrearEditar/Stock.vue"
import ProyectoFacturacion from "./Componentes/Proyectos/CrearEditar/Facturacion.vue"

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
  components: {
    VDateInput,
  },
  directives,
  theme: {
    themes: {
      light: {
        dark: false,
        colors: {
          primary: '#113065',
          first: '#0f1056',
          second: '#151269', 
          thirth: '#81b1ce',
          fourth: '#aad6ec',
          cancel: "#FF0000",
          link: "#409fff",
        },
      },
    },
  },
})

app.use(RouterWeb);
app.use(vuetify);
app.use(store)

app.component('Login', LoginPage)
app.component('Registro', RegistroPage)
app.component('Main', MainPage)

app.component('Navbar', NavbarComponent)
app.component('Header', HeaderComponent)

app.component('HomeLeft', HomeLeft)
app.component('HomeCenter', HomeCenter)
app.component('HomeRight', HomeRight)

app.component('CrearEditarProyecto', CrearEditarProyecto)
app.component('ProyectoGeneral', ProyectoGeneral)
app.component('ProyectoDesarrollo', ProyectoDesarrollo)
app.component('ProyectoStock', ProyectoStock)
app.component('ProyectoFacturacion', ProyectoFacturacion)


app.mount('#app');