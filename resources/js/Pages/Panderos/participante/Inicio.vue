<template>
     <div class="card card-primary card-outline">
        <div class="card-header">
            <h6 class="card-title">
                Listado Participantes&nbsp;
                <a class="btn btn-danger btn-sm"
                    @click.prevent="nuevo">
                    <i class="fa fa-plus"></i>
                </a>
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-1 mb-1">
                    <select class="form-control form-control-sm" @change="cambiarPaginacion"
                        v-model="dato.paginacion" >
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-md-5 mb-1">
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Mostrar <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                            <a class="dropdown-item" href="" @click.prevent="mostrarTodos">Todos</a>
                            <a class="dropdown-item" href="" @click.prevent="mostrarHabilitados">Habilitados</a>
                            <a class="dropdown-item" href="" @click.prevent="mostrarEliminados">Eliminados</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Buscar</span>
                        </div>
                        <input type="text" class="form-control" v-model="dato.buscar"
                            placeholder="Ingrese Usuario, nombres, apellidos, etc."
                            @change="buscar" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-1">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="8" class="text-center"> Participantes - {{ dato.show_tipo }}</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Nro. Documento</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>telefono</th>
                                    <!-- <th>Es Activo</th> -->
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="participantes.total == 0" >
                                    <td colspan="8" class="text-danger text-center table-danger">-- Datos no registrados--</td>
                                </tr>
                                <tr v-else v-for="(participa,index) in participantes.data" :key="participa.id">
                                    <td>{{  index + participantes.from }}</td>
                                    <td v-text="participa.persona.numero_documento"></td>
                                    <td v-text="participa.persona.nombres"></td>
                                    <td v-text="participa.persona.apellido_paterno+' '+participa.persona.   apellido_materno"></td>
                                    <td v-text="participa.persona.telefono"></td>
                                    <td>
                                        <button class="btn btn-info btn-xs mr-1" title="Mostrar Rol" @click.prevent="mostrar(participa.id)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-warning btn-xs mr-1" title="Editar Rol" @click.prevent="editar(participa.id)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-xs mr-1" title="Enviar a Papelera" @click.prevent="eliminar(participa.id, 'Temporal')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Mostrando <b>{{participantes.from}}</b> a <b>{{ participantes.to }}</b> de <b>{{ participantes.total}}</b> Registros
                </div>
                <div class="col-md-6 text-right">
                    <nav>
                        <ul class="pagination">
                            <li v-if="participantes.current_page >= 2" class="page-item">
                                <a href="#" aria-label="Previous" class="page-link"
                                    title="Primera Página"
                                    @click.prevent="cambiarPagina(1)">

                                    <span><i class="fas fa-backward-fast"></i></span>
                                </a>
                            </li>
                            <li v-if="participantes.current_page > 1" class="page-item">
                                <a href="#" aria-label="Previous" class="page-link"
                                    title="Página Anterior"
                                    @click.prevent="cambiarPagina(participantes.current_page - 1)">

                                    <span><i class="fas fa-angle-left"></i></span>
                                </a>
                            </li>
                            <li v-for="page in pagesNumber()" class="page-item"
                                :key="page"
                                :class="[ page == isActived() ? 'active' : '']"
                                :title="'Página '+ page">
                                <a href="#" class="page-link"
                                    @click.prevent="cambiarPagina(page)">{{ page }}</a>
                            </li>
                            <li v-if="participantes.current_page < participantes.last_page" class="page-item">
                                <a href="#" aria-label="Next" class="page-link"
                                    title="Página Siguiente"
                                    @click.prevent="cambiarPagina(participantes.current_page + 1)">
                                    <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                                </a>
                            </li>
                                <li v-if="participantes.current_page <= participantes.last_page-1" class="page-item">
                                <a href="#" aria-label="Next" class="page-link"
                                    @click.prevent="cambiarPagina(participantes.last_page)"
                                    title="Última Página">
                                    <span aria-hidden="true"><i class="fas fa-forward-fast"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <participante-form :form="form" @onParticipantes="listarParticipantes"></participante-form>
</template>

<script>
import { onMounted, computed, ref } from 'vue'
import useHelper from '@/Helpers'
import useParticipante from '@/Composables/Pandero/participantes'
import ParticipanteForm from './Form.vue'

export default {
    components:{
        ParticipanteForm
    },
    setup() {
        const { defineTitle, Swal, Toast  } = useHelper()

        const {
            participantes, participante, errors,
            obtenerParticipantes, obtenerParticipante
        } = useParticipante()

        const show_tipo = ref("habilitados")

        const offset = 4

        const dato = ref({
            page : '',
            buscar : '',
            show_tipo : 'habilitados',
            paginacion : 5
        })

        const form = ref({
            id:'',
            descripcion:'',
            monto:'',
            fecha_inicio:'',
            es_activo:1,
            estadoCrud:'nuevo',
            errors:[]
        })

        const listarParticipantes = async(page=1) => {
            dato.value.page = page
            await obtenerParticipantes(dato.value)
        }

        onMounted(() => {
            defineTitle('Participantes')
            listarParticipantes()
        })

        const cambiarPaginacion = (event) => {
            //dato.value.paginacion = event.target.value
            listarParticipantes()
        }
        const mostrarHabilitados = async  () => {
            show_tipo.value = 'habilitados'
            dato.value.show_tipo = 'habilitados'
            listarParticipantes()
        }

        const mostrarEliminados = async  () => {
            show_tipo.value = 'eliminados'
            dato.value.show_tipo = 'eliminados'
            listarParticipantes()
        }

        const mostrarTodos = async  () => {
            show_tipo.value = 'todos'
            dato.value.show_tipo = 'todos'
            listarParticipantes()
        }

        const buscar = async() => {
            //dato.value.buscar = event.target.value
            listarParticipantes()
        }

        const isActived = () => {
            return participantes.value.current_page
        }

        const pagesNumber = () => {
            if(!participantes.value.to){
                return []
            }

            let from = participantes.value.current_page - offset

            if(from < 1) from = 1

            let to = from + (offset*2)

            if( to >= participantes.value.last_page) to = participantes.value.last_page

            let pagesArray = []

            while(from <= to) {
                pagesArray.push(from)
                from ++
            }

            return pagesArray
        }

        const cambiarPagina = (pagina) =>{
            participantes.value.current_page = pagina
            listar(pagina)
        }

        computed(() => {
            isActived()
            pagesNumber()
        })

        const limpiarDatos = () => {
            form.value.id =""
            form.value.tipo_documento_id = ""
            form.value.numero_documento= ""
            form.value.nombres= ""
            form.value.apellido_paterno= ""
            form.value.apellido_materno = ""
            form.value.sexo_id = ""
            form.value.telefono = ""
            form.value.direccion = ""
        }
        const nuevo =() => {
            limpiarDatos()
            form.value.estadoCrud = 'nuevo'
            $('#modal-title-participante').html('Nuevo Participante')
            $('#modal-participante').modal('show')
        }

        const obtenerDatos = async(id) => {
            await obtenerParticipante(id)
            limpiarDatos()
            let persona = participante.value
            if(persona)
            {
                form.value.id =persona.id
                form.value.tipo_documento_id = persona.persona.tipo_documento_id
                form.value.numero_documento= persona.persona.numero_documento
                form.value.nombres= persona.persona.nombres
                form.value.apellido_paterno= persona.persona.apellido_paterno
                form.value.apellido_materno = persona.persona.apellido_materno
                form.value.sexo_id = persona.persona.sexo_id
                form.value.telefono = persona.persona.telefono
                form.value.direccion = persona.persona.direccion
            }
        }

        const mostrar = (id) => {
            obtenerDatos(id)
            form.value.estadoCrud = 'mostrar'
            $('#modal-title-participante').html('Datos Participante')
            $('#modal-participante').modal('show')
        }

        const editar = (id) => {
            obtenerDatos(id)
            form.value.estadoCrud = 'editar'
            $('#modal-title-participante').html('Editar Participante')
            $('#modal-participante').modal('show')
        }

        const eliminar = (id) => {
            Swal.fire({
                    title: "Participantes",
                    text: "¿Estás seguro de Eliminar?",
                    icon: "question",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "Si",
                    showCancelButton: true,
                    cancelButtonText: "No",
                    cancelButtonColor:'#c82333'
                }).then((result) => {
                    if(result.isConfirmed) {
                        // if(tipo=='Temporal'){
                        //     eliminarTemporal(id)
                        // }else{
                        //     eliminarPermanente(id)
                        // }
                    }
                });
        }

        return {
            dato, form, participantes, errors,
            listarParticipantes, cambiarPaginacion, mostrarHabilitados, mostrarEliminados, mostrarTodos,
            buscar, nuevo, mostrar, editar, eliminar, cambiarPagina, isActived, pagesNumber
        }
    },
}
</script>
