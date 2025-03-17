import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import RouterWeb from './router/index'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import App from './web/App.vue';
import LoginPage from "./web/Login.vue"
import MainPage from "./web/Main.vue"
import HomePage from "./Componentes/Home/Home.vue"

import HeaderComponent from "./Componentes/Header.vue"
import NavbarComponent from "@/Componentes/Navbar.vue";
import HomeLeft from "./Componentes/Home/HomeLeft.vue"
import HomeCenter from "./Componentes/Home/HomeCenter.vue"
import HomeRight from "./Componentes/Home/HomeRight.vue"

const app = createApp(App);
const vuetify = createVuetify({
  components,
  directives,
})

app.use(RouterWeb);
app.use(vuetify)

app.component('Login', LoginPage)
app.component('Main', MainPage)
app.component('Home', HomePage)

app.component('Navbar', NavbarComponent)
app.component('Header', HeaderComponent)
app.component('HomeLeft', HomeLeft)
app.component('HomeCenter', HomeCenter)
app.component('HomeRight', HomeRight)

app.mount('#app');