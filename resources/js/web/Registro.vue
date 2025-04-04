<template>
    <v-card class="mx-auto" max-width="50%">
        <v-toolbar color="primary">
            <v-toolbar-title class="text-center"><b>CREAR NUEVO USUARIO</b></v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-form ref="form" v-model="formconfirm" @submit.prevent="signin()">
                <v-text-field 
                    v-model="username"    
                    :rules="[rules.required]"       
                    prepend-icon="mdi-account"      
                    type="text"     
                    label="Nombre Completo">
                </v-text-field>
                <v-text-field 
                    v-model="usermail"    
                    :rules="[rules.required]"       
                    prepend-icon="mdi-at"           
                    type="text"     
                    label="E-mail">
                </v-text-field>
                <v-text-field 
                    v-model="usercompany"    
                    :rules="[rules.required]"       
                    prepend-icon="mdi-factory"      
                    type="text"     
                    label="Nombre Empresa">
                </v-text-field>
                <v-text-field 
                    v-model="userpass"    
                    :rules="[rules.required]"       
                    prepend-icon="mdi-lock"         
                    @click:append-inner="show1 = !show1" 
                    :append-inner-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" 
                    :type="show1 ? 'text' : 'password'" 
                    label="Contraseña">
                </v-text-field>
                <v-text-field 
                    v-model="confirmpass" 
                    :rules="[rules.confirm]"        
                    prepend-icon="mdi-lock-alert"   
                    type="password" 
                    label="Confirmar Contraseña">
                </v-text-field>
                <v-row class="ma-0">
                    <v-btn type="submit" block rounded color="first" :disabled = !formconfirm>Crear Usuario</v-btn>
                </v-row>
            </v-form>

            <v-row class="mt-8 mb-4">
                <v-spacer/>
                <v-btn rounded color="link" @click="changeView()">Iniciar Sesión</v-btn>
                <v-spacer/>
            </v-row>
        </v-card-text>
    </v-card>
  </template>

<script>
import axios from "axios";

export default {
  components: {  },

  data() {
      return {
        formconfirm: false,
        username: null,
        usermail: null,
        usercompany: null,
        userpass: null,
        confirmpass: null,
        show1: false,

        rules: {
            required: (value) => !!value || "Campo requerido.",
            confirm: (value) => value == this.userpass || "Las contraseñas no coinciden.",
         },
      };
  },

  methods: {
        signin: function () {
            let credenciales = {
                name: this.username,
                email: this.usermail,
                password: this.userpass,
                company: this.usercompany,
            };

            axios
                .post("/api/user/signUp", credenciales)
                .then((response) => {
                    alert("Usuario Creado Correctamente");
                    this.$emit("changeView");
                })
                .catch((error) => {
                    alert("Error al crear el Usuario");
                });

        },
        changeView() {
            this.$emit("changeView");
        },
    }  
}
  
</script>
