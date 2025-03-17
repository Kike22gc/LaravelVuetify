<template v-slot:prepend>
    <v-list density="compact" :elevation="3">
        <v-list-item class="mt-4" >
            <img src="https://randomuser.me/api/portraits/women/64.jpg">                    
        </v-list-item>
        <v-list-title class="mx-4">AAAA</v-list-title>
    </v-list>
    
    <v-list :elevation="3">
      <v-list-item prepend-icon="mdi-logout" title="Cerrar Sesion" @click="logout()"></v-list-item>
    </v-list>
    
</template>
   
   <script>
    export default {
     data () {
      return {
       items: [
        { text: 'Real-Time', icon: 'mdi-clock' },
        { text: 'Audience', icon: 'mdi-account' },
        { text: 'Conversions', icon: 'mdi-flag' },
       ],
      }
     },

     methods: {
        logout: function () {
            this.$router.push("/").catch((err) => err);
            this.$emit('Logout')
        }
    },

    }
   </script>