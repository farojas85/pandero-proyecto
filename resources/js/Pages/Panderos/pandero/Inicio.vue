<template>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h6 class="card-title">
                Listado Panderos&nbsp;
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
                            <a class="dropdown-item" href="" @click.prevent="mostrarActivos">Activos</a>
                            <a class="dropdown-item" href="" @click.prevent="mostrarInactivos">Inactivos</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Buscar</span>
                        </div>
                        <input type="text" class="form-control" v-model="dato.buscar"
                            placeholder="Ingrese descripcion de pandero a buscar"
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
                                    <th colspan="8" class="text-center"> Panderos - {{ dato.show_tipo }}</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Descripci&oacute;n</th>
                                    <th>Monto</th>
                                    <th>Fecha Inicio</th>
                                    <!-- <th>telefono</th> -->
                                    <!-- <th>Es Activo</th> -->
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="panderos.total == 0">
                                    <td colspan="6" class="table-danger text-center text-danger">
                                        --Datos no registrados--
                                    </td>
                                </tr>
                                <tr v-else v-for="(pande,index) in panderos.data" :key="pande.id">
                                    <td>{{  index + panderos.from }}</td>
                                    <td v-text="pande.descripcion"></td>
                                    <td v-text="pande.monto"></td>
                                    <td v-text="pande.fecha_inicio"></td>
                                    <td>
                                        <button class="btn btn-info btn-xs mr-1" title="Mostrar Pandero" @click.prevent="mostrar(pande.id)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-warning btn-xs mr-1" title="Editar Pandero" @click.prevent="editar(pande.id)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-xs mr-1" title="Enviar a Papelera" @click.prevent="eliminar(pande.id, 'Temporal')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <pandero-form :form="form" @onPanderos = "listarPanderos"></pandero-form>
</template>

<script>
import { onMounted, computed, ref } from 'vue'
import useHelper from '@/Helpers'
import usePandero from '@/Composables/Pandero/panderos'
import PanderoForm from './Form.vue'

export default {
    components:{
        PanderoForm
    },
    setup() {

        const { defineTitle, Swal, Toast  } = useHelper()

        const {
            errors, pandero, panderos,
            obtenerPanderos
        } = usePandero()

        const show_tipo = ref("activos")

        const offset = 4

        const dato = ref({
            page : '',
            buscar : '',
            show_tipo : 'activos',
            paginacion : 5
        })

        const form = ref({
            id:'',
            descripcion:'',
            monto:'',
            fecha_inicio:'',
            es_activo:'',
            estadoCrud:'nuevo',
            errors:[]
        })

        const listarPanderos = async(page=1) => {
            dato.value.page = page
            await obtenerPanderos(dato.value)
        }

        onMounted(() => {
            defineTitle('Panderos')
            listarPanderos()
        })

        const cambiarPaginacion = (event) => {
            //dato.value.paginacion = event.target.value
            listarPanderos()
        }
        const mostrarActivos = async  () => {
            show_tipo.value = 'activos'
            dato.value.show_tipo = 'activos'
            listarPanderos()
        }

        const mostrarInactivos = async  () => {
            show_tipo.value = 'inactivos'
            dato.value.show_tipo = 'inactivos'
            listarPanderos()
        }

        const mostrarTodos = async  () => {
            show_tipo.value = 'todos'
            dato.value.show_tipo = 'todos'
            listarPanderos()
        }

        const buscar = async() => {
            //dato.value.buscar = event.target.value
            listarPanderos()
        }

        const limpiarDatos = () => {
            form.value.id=''
            form.value.descripcion=''
            form.value.monto=''
            form.value.fecha_inicio=''
            form.value.es_activo=''
            form.value.errors=[]
        }
        const nuevo = () => {
            limpiarDatos()
            form.value.estadoCrud = 'nuevo'
            $('#modal-title-pandero').html('Nuevo Pandero')
            $('#modal-pandero').modal('show')
        }

        const mostrar = () => {

        }

        const editar = () => {

        }

        const eliminar = () => {

        }

        return {
            dato, form, panderos,
            listarPanderos, cambiarPaginacion, mostrarActivos, mostrarInactivos, mostrarTodos,
            nuevo, mostrar, editar, eliminar
        }
    },
}
</script>
