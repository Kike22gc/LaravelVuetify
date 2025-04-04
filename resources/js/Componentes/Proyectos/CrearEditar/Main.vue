<template>
  <v-dialog v-model="showDialog" fullscreen>
    <v-card>
      <v-toolbar dense>
          <v-toolbar-title class="ml-4">{{this.title}}</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn icon @click="showDialog=false" class="btn-close"><v-icon>mdi-close</v-icon></v-btn>
      </v-toolbar>

      <v-card-title>
        <v-row>
          <v-col> <v-btn block @click.stop="viewPage='GENERAL'"     :color = "viewPage=='GENERAL' ? 'first' : '' ">GENERAL</v-btn> </v-col>
          <v-col> <v-btn block @click.stop="viewPage='DESARROLLO'"  :color = "viewPage=='DESARROLLO' ? 'first' : '' ">DESARROLLO</v-btn> </v-col>
          <v-col> <v-btn block @click.stop="viewPage='STOCK'"       :color = "viewPage=='STOCK' ? 'first' : '' ">STOCK</v-btn> </v-col>
          <v-col> <v-btn block @click.stop="viewPage='FACTURACION'" :color = "viewPage=='FACTURACION' ? 'first' : '' ">FACTURACION</v-btn> </v-col>
        </v-row>
      </v-card-title>
      
      <v-card-text>
        <div class="height=100%" scrollable>
          <ProyectoGeneral      v-if="viewPage=='GENERAL'"    v-bind:project="project"></ProyectoGeneral>
          <ProyectoDesarrollo   v-if="viewPage=='DESARROLLO'" v-bind:project="project"></ProyectoDesarrollo>
          <ProyectoStock        v-if="viewPage=='STOCK'"      v-bind:project="project"></ProyectoStock>
          <ProyectoFacturacion  v-if="viewPage=='FACTURACION'"v-bind:project="project"></ProyectoFacturacion>
        </div>
      </v-card-text>

      <template v-slot:actions>
        <v-btn color="red" variant="outlined">CANCELAR</v-btn>
        <v-btn color="first" variant="outlined" @click="create()">GUARDAR</v-btn>
      </template>

    </v-card>

    

  </v-dialog>
  </template>

<script>

export default {
  props: ['visible', 'isNewProject', 'project'],

  data() {
      return {
        viewPage: 'GENERAL',

        title: null,
      };
  },
  computed: {
    
    showDialog: {
      get () {
        if(this.visible) {
          this.initialize()
        }
        return this.visible
      },
      set (value) {
        if (!value) {
          this.$emit('close')
        }
      }
    }
  }, 
  
  methods: {
    initialize: function() {
      this.title = this.isNewProject ? 'Nuevo Proyecto' : 'El proyecto ya existe'
    },

    create: function() {
      console.log(this.project)
    }
  },
}
  
</script>