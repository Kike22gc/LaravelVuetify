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
          label="Buscar"
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
      loading-text="Cargando los proyectos... por favor espera un momento."
      no-data-text="No existen proyectos. Puedes crear uno haciendo clic en Nuevo Proyecto."
      itemsPerPageText="Proyectos por página"
      :pageText="'{0}-{1} de {2}'"
      first-page-label=""
      last-page-label=""
      next-page-label=""
      prev-page-label=""
    >
      <template v-slot:[`item.project_name`]="{ item }">
        <v-card elevation="0">
          <v-toolbar-title> {{ item.project_name }} </v-toolbar-title>
          {{ item.project_description }}
        </v-card>
      </template>

      <template v-slot:[`item.project_target_date`]="{ item }">
        {{ item.project_target_date }} 
      </template>

      <template v-slot:[`item.project_state`]="{ item }">
        <v-chip variant="outlined" color="orange" v-if="item.project_state == 'Borrador'"> {{item.project_state}} </v-chip>
        <v-chip variant="outlined" color="blue"   v-if="item.project_state == 'Activo'" > {{item.project_state}} </v-chip>
      </template>

      <template v-slot:[`item.edit`]="{ item }">
          <v-icon class="ma-1" v-tooltip:bottom="'Solo Lectura'" @click="">mdi-magnify</v-icon> 
          <v-icon class="ma-1" v-tooltip:bottom="'Editar'"       @click="EditProject(item)">mdi-pencil</v-icon>
      </template>

    </v-data-table>
  </v-card>

  <CrearEditarProyecto
    :visible="ShowProyecto"
    v-bind:isNewProject="isNewProject"
    v-bind:project="project"
    @close="cancel()"
    @ok="saveOK()">
  </CrearEditarProyecto>

</template>

<script>
import APIProject from "../../Interface/Project";
import moment from "moment"

    export default {
     data () {
      return {
         project: [],

         search: null,
         isLoadingProjects: false,

         headers: [
         { key: 'project_name', title: 'Proyecto', sortable: true, align: 'start', },
         { key: 'client_name', title: 'Cliente', sortable: true, align: 'start', },
         { key: 'project_target_date', title: 'Fecha Objetivo', sortable: true, align: 'start', },
         { key: 'project_end_date', title: 'Fecha Limite', sortable: true, align: 'start', },
         { key: 'project_state', title: 'Estado', sortable: false, align: 'center', },
         { key: 'edit', title: 'Estado', sortable: false, align: 'center', },
        ],
        
        projects: [],

        ShowProyecto: false,
        isNewProject: false,

      }
     },

     created() {
      this.initialize();
     }, 

     methods: {

      initialize: function() {
        this.getProjectList();
      },

      getProjectList: function() {
        let data = {
        companyID: this.$store.state.company_id
      }

      axios
        .post("/api/projects/getList", data)
        .then((response) => {
          this.projects = response.data.companyProjectList
        })
        .catch((error) => {
            alert('Error al cargar los proyectos de la compañia')
        });
      },

      NewProject: function() {
        this.ShowProyecto = true,
        this.isNewProject = true,
        this.project = Object.assign({}, APIProject.emptyProject);
      },

      EditProject: function(item) {
        this.ShowProyecto = true,
        this.isNewProject = false,
        this.project = Object.assign({}, item);
      },

      cancel: function() {
        this.ShowProyecto = false;
        this.project = Object.assign({}, APIProject.emptyProject);
      },

      saveOK: function() {
        this.ShowProyecto = false;
        this.initialize();
      }
    }

    }
   </script>