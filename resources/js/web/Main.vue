<template>
    <v-layout style="height: 100vh;" class="rounded rounded-md border ">
      <Header v-if="authentication" @Logout="Logout" @OpenCloseNavbar="OpenCloseNavbar"></Header>
  
      <v-navigation-drawer v-if="authentication" v-model="vShowNavbar">
        <Navbar></Navbar>
      </v-navigation-drawer>
  
      <v-main class="d-flex align-center justify-center" >
        <v-container>
          <router-view></router-view>       
        </v-container>
      </v-main>
    </v-layout>
  </template>

<script>

export default {
  props: ["authentication"],
  components: {  },

  data() {
      return {
        vShowNavbar: false
      };
  },

  methods: {
    OpenCloseNavbar: function () {
        this.vShowNavbar = !this.vShowNavbar;
        console.log(this.vShowNavbar)
    },

    Logout: function () {
        this.vShowNavbar = !this.vShowNavbar;
        this.$emit("Logout")
    }
  }
  
}
  
</script>
