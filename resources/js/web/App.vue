<template>
  <div>Counter: {{ count }}</div>
  <v-btn @click="increment()">Increment</v-btn>
</template>

<script>
  export default {
    data () {
      return {
        count: this.$store.state.count
      }
    },

    created() {
    },

    mounted() { 
    },

    computed: {
    },

    methods: {
      increment() {
        this.$store.commit('increment')
        console.log(this.$store.state.count)
      }
    }
  }
</script>
