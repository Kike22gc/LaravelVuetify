<template>
  <v-row>
    <v-spacer/>
    <v-btn class="ma-2" color="first" @click="NewProject()">crear nuevo proyecto</v-btn>
  </v-row>

   <v-card
    title="Proyectos"
    flat
    class="my-2"
  >
    <template v-slot:text>
      <v-row>
        <v-text-field
          v-model="search"
          label="Search"
          prepend-inner-icon="mdi-magnify"
          variant="outlined"
          hide-details
          single-line
        ></v-text-field>
      </v-row>
      
    </template>

      <v-data-table
      dense
      :headers="headers"
      :items="projects"
      items-per-page="5"
      :search="search"
      :loading="isLoadingProjects"
      loading-text="Cargando las campañas... por favor espera un momento."
      no-data-text="No existen campañas. Puedes crear una haciendo clic en Nueva Campaña."
    ></v-data-table>
  </v-card>

  <CrearEditarProyecto
    :visible="ShowProyecto"
    v-bind:isNewProject="isNewProject"
    v-bind:project="project"
    @close="cancel()">
  </CrearEditarProyecto>

</template>

<script>
import APIProject from "../../Interface/Project";

    export default {
     data () {
      return {
         project: [],

         search: null,
         isLoadingProjects: false,

         headers: [
         { key: 'name', title: 'Dessert (100g serving)', sortable: true, align: 'start', },
         { key: 'calories', title: 'Calories' },
         { key: 'fat', title: 'Fat (g)' },
         { key: 'carbs', title: 'Carbs (g)' },
         { key: 'protein', title: 'Protein (g)' },
         { key: 'iron', title: 'Iron (%)' },
        ],
        
        projects: [
         { name: 'Frozen Yogurt', calories: 159, fat: 6, carbs: 24, protein: 4, iron: 1, },
         { name: 'Frozen Yogurt', calories: 159, fat: 6, carbs: 24, protein: 4, iron: 1, },
         { name: 'Frozen Yogurt', calories: 159, fat: 6, carbs: 24, protein: 4, iron: 1, },
         { name: 'Frozen Yogurt', calories: 159, fat: 6, carbs: 24, protein: 4, iron: 1, },
         { name: 'Frozen Yogurt', calories: 159, fat: 6, carbs: 24, protein: 4, iron: 1, },
         { name: 'Frozen Yogurt', calories: 159, fat: 6, carbs: 24, protein: 4, iron: 1, },
         { name: 'Frozen Yogurt', calories: 159, fat: 6, carbs: 24, protein: 4, iron: 1, },
         { name: 'Frozen Yogurt', calories: 159, fat: 6, carbs: 24, protein: 4, iron: 1, },
        ],

        ShowProyecto: false,
        isNewProject: false,

      }
     },

     methods: {
      NewProject: function() {
        this.ShowProyecto = true,
        this.isNewProject = true,
        this.project = Object.assign({}, APIProject.emptyProject);
      },

      cancel: function() {
        this.ShowProyecto = false;
      }
    }

    }
   </script>