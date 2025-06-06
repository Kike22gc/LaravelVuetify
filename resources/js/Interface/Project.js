export default class APIProject {

    constructor(id) {
        this.id = id;
    }

    static emptyProject = {
        project_name: null,
        project_description: null,
        clients_client_id: null,
        client_contact_client_contact_id: null,
        Proyecto_NuevoCliente: null,
        Proyecto_NuevoContacto: {
            Contacto_Nombre: null,
            Contacto_Email: null,
            Contacto_Telefono: null,
        },
        project_start_date: null,
        project_target_date: null,
        project_end_date: null,
        Proyecto_Usuario_Asignado: null,
        Proyecto_Estado: 'Borrador',
        project_tasks: [],
    }
}