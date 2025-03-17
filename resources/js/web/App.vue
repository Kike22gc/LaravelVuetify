<template>
  <v-app :class="getState">
      <v-main>
          <Login v-if="authentication === false"></Login>
          <Main v-if="authentication"></Main>
      </v-main>
  </v-app>
</template>

<script>
import Main from './Main.vue';

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
