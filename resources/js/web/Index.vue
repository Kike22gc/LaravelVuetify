<template>
  <v-theme-provider>
    <v-app :class="getState">
        <v-main>
            <Login v-if="authentication === false"></Login>
            <Main v-if="authentication"></Main>
        </v-main>
    </v-app>
  </v-theme-provider>
</template>

<script>
import Main from './App.vue';


  export default {
    data () {
      return {  
        authentication: false,
      }
    },

    created() {
    },

    computed: {
      getState() {
            this.authentication = this.$store.getters.isUserLogged;
            return this.authentication ? "user-logged" : "user-anonymous";
        },
    },

    mounted() { 

      const Self = this;
        this.$store.dispatch('setLogin', function() {
            Self.authentication = Self.$store.getters.isUserLogged;

            if (!Self.authentication) {
                Self.$router.push("/").catch((err) => err);
            }
            if (Self.authentication && window.location.pathname == "/") {
                Self.$router.push("/home").catch((err) => err);
            }
        });
    },

    methods: {
    }
  }
</script>
