<template>
    <v-card class="mx-auto my-12" max-width="50%">
        <v-toolbar color="first">
            <v-toolbar-title class="text-center"><b>BIENVENIDO A: XXXXX</b></v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-form>
              <v-text-field v-model="usermail"    prepend-icon="mdi-at"   label="E-mail"></v-text-field>
              <v-text-field v-model="userpass"    prepend-icon="mdi-lock" @click:append-inner="show1 = !show1" :append-inner-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"    :type="show1 ? 'text' : 'password'" label="Contraseña"></v-text-field>
            </v-form>
            <v-card-actions> 
                <v-spacer/>  
                <v-btn color="link">¿Has olvidado tu contraseña?</v-btn>
            </v-card-actions>
            <v-row class="ma-0">
                <v-btn block rounded color="first" @click="login()">Iniciar Sesión</v-btn>
            </v-row>
            <v-row class="mt-8 mb-4">
                <v-spacer/>
                <v-btn rounded color="link" @click="changeView()">Crear Usuario</v-btn>
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
        usermail: 'a@a.es',
        userpass: 'a',
        show1: false
      };
  },

  methods: {
    login: function () {
        let Self = this;
        
        let credenciales = {
            email: this.usermail,
            password: this.userpass,
        };

        axios
            .post("/api/user/login", credenciales)
            .then((response) => {
                if(response.data.status == 'OK'){

                    this.usuario = response.data[0];

                    Self.$store.dispatch("setLogin", () => {
                        Self.$router.push("/home").catch((err) => err);
                    });
                    }
            })
            .catch((error) => {
                alert('Usuario o contraseeña incorrectos')
            });
    },
    changeView() {
        this.$emit("changeView");
    },
  }

  
}
  
</script>
