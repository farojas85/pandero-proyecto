<template>
    <content-header :titulo="titulo" :icon="icon" :subTitulo="subTitulo"></content-header>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-app bg-primary" @click.prevent="cambiarVista('Participantes','fa fa-users')" >
                                <i class="fa fa-users"></i> Participantes
                            </button>
                            <!-- <button class="btn btn-app bg-primary" @click.prevent="cambiarVista('Tipo Accesos','fas fa-low-vision')" >
                                <i class="fas fa-low-vision"></i> Tipo Acceso
                            </button>
                            <button class="btn btn-app bg-primary" @click.prevent="cambiarVista('Roles','fas fa-tags')" >
                                <i class="fas fa-tags"></i> Roles
                            </button>
                            <button class="btn btn-app bg-primary" @click.prevent="cambiarVista('Menús','fas fa-bars')" >
                                <i class="fas fa-bars"></i> Men&uacute;s
                            </button> -->
                        </div>
                        <div class="card-body">
                            <participante-view  v-if="vista=='Participantes'"></participante-view>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { onMounted,ref } from 'vue'
import ContentHeader from '@/Components/Partials/ContentHeader.vue'
import ParticipanteView from './participante/Inicio.vue'
export default {
    components:{
        ContentHeader, ParticipanteView
    },
    setup() {
        const titulo = ref("Participantes")
        const icon = ref("")
        const subTitulo = ref("Participantes")
        const vista = ref("Participantes")

        const cambiarVista = (nuevaVista,icono) => {
            vista.value = nuevaVista
            titulo.value = nuevaVista
            icon.value = icono
            subTitulo.value = nuevaVista
        }

        return {
            titulo, subTitulo, vista, cambiarVista, icon
        }
    },
}
</script>
