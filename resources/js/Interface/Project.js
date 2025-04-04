export default class APIProject {

    constructor(id) {
        this.id = id;
    }

    static emptyProject = {
        Proyecto_Nombre: null,
        Proyecto_Descripcion: null,
        Proyecto_Cliente: null,
        Proyecto_NuevoCliente: null,
        Proyecto_Contacto: null,
        Proyecto_NuevoContacto: {
            Contacto_Nombre: null,
            Contacto_Email: null,
            Contacto_Telefono: null,
        },
        Proyecto_Fecha_Inicio: null,
        Proyecto_Fecha_Objetivo: null,
        Proyecto_Fecha_Fin: null,
        Proyecto_Usuario_Asignado: null,
        Proyecto_Estado: 'Borrador',
        Proyecto_Tareas: [
            {
                Proyecto_Tarea_ID: 1,
                Proyecto_Tarea_Titulo: 'Tarea1',
                Proyecto_Tarea_Descripcion: 'Descripcion1',
                Proyecto_Tarea_Activo: false,
            },
            {
                Proyecto_Tarea_ID: 2,
                Proyecto_Tarea_Titulo: 'Tarea2',
                Proyecto_Tarea_Descripcion: 'Descripcion2',
                Proyecto_Tarea_Activo: true,
            },
        ],
    }
}