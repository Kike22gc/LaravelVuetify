import { createRouter, createWebHistory } from 'vue-router';

const AppComponent = () => import ('../web/Index.vue')
const HomeComponent = () => import ('../Componentes/Home/Home.vue')

const EmpleadosComponent = () => import ('../Componentes/Empleados/Empleados.vue');


const routes=[
{ path:'/', name:'App', component:AppComponent},
{ path:'/home', name:'Home', component:HomeComponent},
{ path:'/empleados', name:'Empleados', component:EmpleadosComponent},
];

const router = createRouter({
 history: createWebHistory(import.meta.env.BASE_URL),
 routes
});


export default router;