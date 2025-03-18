<template >
    <v-card class="mx-auto my-12" max-width="50%">
        <v-toolbar color="primary">
            <v-toolbar-title>Iniciar Sesion</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-form>
              <v-text-field v-model="vEmail" prepend-icon="mdi-at" type="text" label="E-mail"></v-text-field>
              <v-text-field v-model="vPass" prepend-icon="mdi-lock" type="password" label="Contraseña"></v-text-field>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-btn rounded color="primary" dark @click="signin()">Registrarse</v-btn>
            <v-spacer/>
            <v-btn rounded color="primary" dark @click="login()">Iniciar Sesion</v-btn>
        </v-card-actions>
    </v-card>
  </template>

<script>
import axios from "axios";

export default {
  components: {  },

  data() {
      return {
        usuario: [],
        vEmail: 'b@b.es',
        vPass: 'B',
      };
  },

  methods: {
    signin: function () {
        let credenciales = {
            email: this.vEmail,
            password: this.vPass,
        };

        axios
            .post("/api/user/signUp", credenciales)
            .then((response) => {
                alert("Usuario Creado Correctamente");
            })
            .catch((error) => {
                alert("Error al crear el Usuario");
            });

    },

    login: function () {
        let Self = this;
        
        let credenciales = {
            email: this.vEmail,
            password: this.vPass,
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
  }

  
}
  
</script>
