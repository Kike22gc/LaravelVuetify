<template>
  <v-card class="mx-auto"
    max-width="60%">

      <v-text-field
        autofocus
        :rules="[rules.required]"
        counter="60"
        maxlength="60"
        v-model="newTaskTitle"
        label="Titulo de la Tarea"
      >
      </v-text-field>
      <v-text-field
        :rules="[]"
        counter="180"
        maxlength="180"
        v-model="newTaskSubtitle"
        label="Descripcion de la Tarea"
      >
      </v-text-field>
      <v-row class="mb-3">
        <v-spacer/>
        <v-btn color="first" @click="addTask()" :disabled = !newTaskTitle>Añadir Tarea</v-btn>
        <v-spacer/>
      </v-row>

    <v-list lines="two" density="compact">
      <v-list-item
        v-for="item in project.project_tasks"
        :active="item.Proyecto_Tarea_Activo"
         base-color="green"
        :key="item.Proyecto_Tarea_ID"
        :subtitle="item.Proyecto_Tarea_Descripcion"
        :title="item.Proyecto_Tarea_Titulo"
      >
      <template v-slot:prepend>
        <v-checkbox v-model="item.Proyecto_Tarea_Activo"></v-checkbox>
      </template>
    </v-list-item>
    </v-list>
  </v-card>
  
</template>

<script>

export default {
  props: ['project'],

  data() {
      return {
        viewPage: 'General',
        newTaskTitle: null,
        newTaskSubtitle: null,

        rules: {
            required: (value) => !!value || "Campo requerido.",
            confirm: (value) => value == this.userpass || "Las contraseñas no coinciden.",
         },
      };
  },

  methods: {
    addTask: function() {
      let task = {
        Proyecto_Tarea_Titulo: this.newTaskTitle,
        Proyecto_Tarea_Descripcion: this.newTaskSubtitle, 
        Proyecto_Tarea_Activo: false
      }
      this.project.project_tasks.push(task)
      this.newTaskTitle = null
      this.newTaskSubtitle = null
    }
  }
  
}
  
</script>