<template>
    <v-layout style="height: 100vh;" class="rounded rounded-md border ">
      
      <Header @OpenCloseNavbar="OpenCloseNavbar"></Header>
      <Navbar v-model="vShowNavbar"></Navbar>
  
      <v-main class="d-flex align-center justify-center" >
        <v-container>
          <router-view></router-view>       
        </v-container>
      </v-main>

    </v-layout>
  </template>

<script>

export default {
  components: {  },

  data() {
      return {
        vShowNavbar: false
      };
  },

  methods: {
    OpenCloseNavbar: function () {
        this.vShowNavbar = !this.vShowNavbar;
    },
  }
  
}
  
</script>
