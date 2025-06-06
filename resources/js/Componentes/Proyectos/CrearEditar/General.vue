<template>
  <v-text-field
      autofocus
      counter="60"
      maxlength="60"
      v-model="project.project_name"
      label="Nombre del Proyecto (*)"
      hint="Máximo 60 caracteres"
  >
  </v-text-field>

  <v-textarea v-model="project.project_description" label="Descripcion"></v-textarea>

  <v-row>
    <v-col>
      <v-switch
        v-model="isNewClient"
        color="primary"
        label="Crear Nuevo Cliente"
        value=True
        hide-details
      ></v-switch>
    </v-col>
    <v-col>
      <v-switch
        v-if="!isNewClient"
        v-model="isNewContact"
        color="primary"
        label="Crear Nuevo Contacto"
        value=True
        hide-details
      ></v-switch>
    </v-col>
  </v-row>
  <v-row>
    <v-col>
      <v-select
        v-if="!isNewClient"
        :items="clientList"
        item-title='client_name'
        item-value='client_id'
        v-model="project.clients_client_id"
        label="Cliente"
        required>
      </v-select>
      <v-text-field
        v-if="isNewClient"
        v-model="project.Proyecto_NuevoCliente"
        label="Nombre del Cliente">
      </v-text-field>
    </v-col>
    <v-col>
      <v-text-field
        v-if="isNewClient || isNewContact"
        v-model="project.Proyecto_NuevoContacto.Contacto_Nombre"
        label="Nombre de la Persona de contacto">
      </v-text-field>
      <v-text-field
        v-if="isNewClient || isNewContact"
        v-model="project.Proyecto_NuevoContacto.Contacto_Email"
        label="Email de la Persona de contacto">
      </v-text-field>
      <v-text-field
        v-if="isNewClient || isNewContact"
        v-model="project.Proyecto_NuevoContacto.Contacto_Telefono"
        label="Telefono de la Persona de contacto">
      </v-text-field>
      <v-select
        v-if="!isNewClient && !isNewContact"
        :items="contactList"
        item-title='client_contact_name'
        item-value='client_contact_id'
        v-model="project.client_contact_client_contact_id"
        label="Persona Contacto"
        required>
      </v-select>
    </v-col>
  </v-row>

  
    <v-row>
      <v-col>
        <v-date-input 
          v-model="project.project_start_date"
          prepend-icon="" 
          prepend-inner-icon="$calendar" 
          label="Fecha Estimada Inicio Proyecto"
          :display-format="format"
          :min="today"
          :max="project.Proyecto_Fecha_Fin">
        </v-date-input>
      </v-col>
      <v-col>
        <v-date-input 
          v-model="project.project_target_date"
          prepend-icon="" 
          prepend-inner-icon="$calendar" 
          label="Fecha Estimada Objetivo"
          :min="project.project_start_date">
        </v-date-input>
      </v-col><v-col>
        <v-date-input 
          v-model="project.project_end_date"
          prepend-icon="" 
          prepend-inner-icon="$calendar" 
          label="Fecha Estimada Fin Proyecto"
          :min="project.project_start_date">
        </v-date-input>
      </v-col>
    </v-row>
  
</template>

<script>
export default {
  props: ['project'],

  data() {
      return {
        clientList: [],
        isNewClient: false,
        clientSelected: null,
        contactList: [],
        isNewContact: false,
        
        today: new Date(),

      };
  },

  mounted() {
    this.initialize();
  },    

  watch: {
    isNewClient() {
      this.project.Proyecto_NuevoContacto.Contacto_Nombre = null
      this.project.Proyecto_NuevoContacto.Contacto_Email = null
      this.project.Proyecto_NuevoContacto.Contacto_Telefono = null
    },

    isNewContact() {
      this.project.Proyecto_NuevoContacto.Contacto_Nombre = null
      this.project.Proyecto_NuevoContacto.Contacto_Email = null
      this.project.Proyecto_NuevoContacto.Contacto_Telefono = null
    },

    project: {
      immediate: true,
      deep: true,
      handler(newValue, oldValue) {
        if(newValue.clients_client_id != this.clientSelected && !this.isNewClient) {
          this.clientSelected = newValue.clients_client_id;
          if (oldValue !== undefined) this.project.client_contact_client_contact_id = null;
          this.getContactList();
        }
      }
    }
  },

  methods: {
    initialize: function() {
      this.getClientList();
      this.getContactList();
      
    },

    getClientList: function() {

      let data = {
        companyID: this.$store.state.company_id
      }
      axios
        .post("/api/clients/getList", data)
        .then((response) => {
          this.clientList = response.data.clientList
        })
        .catch((error) => {
            alert('Error al cargar la lista de clientes de la compañia')
        });
    },

    getContactList: function() {
      let data = {
        clientID: this.project.clients_client_id
      }
      axios
        .post("/api/clients/getContactList", data)
        .then((response) => {
          this.contactList = response.data.clientContactList
        })
        .catch((error) => {
            alert('Error al cargar la lista de contacto del cliente')
        });
    },
  }
  
}
  
</script>