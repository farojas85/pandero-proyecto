<template>
    <form id="form-participantes" @submit.prevent="guardar">
        <div  class="modal fade" id="modal-pandero" tabindex="-1" role="dialog"
        aria-labelledby="ultraModal-Label" aria-hidden="true">
            <div class="modal-dialog animated bounceInDown">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="modal-title-pandero">Section Settings</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3">Descripci&oacute;n</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control form-control-sm" v-model="form.descripcion"
                                :class="{ 'is-invalid' : form.errors.descripcion}"
                                    placeholder="Ingrese Descripción">
                                <small class="text-danger" v-for="error in form.errors.descripcion" :key="error">{{error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3">Monto</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control form-control-sm" v-model="form.monto"
                                    min="200"
                                :class="{ 'is-invalid' : form.errors.monto}"
                                    placeholder="Ingrese Monto del pandero">
                                <small class="text-danger" v-for="error in form.errors.monto" :key="error">{{error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3">Fecha Inicio</label>
                            <div class="col-md-9">
                                <input type="date" class="form-control form-control-sm" v-model="form.fecha_inicio"
                                    min="200"
                                :class="{ 'is-invalid' : form.errors.fecha_inicio}"
                                    placeholder="Ingrese Fecha Inicio">
                                <small class="text-danger" v-for="error in form.errors.fecha_inicio" :key="error">{{error }}</small>
                            </div>
                        </div>
                        <div class="form-group row" v-if="form.estadoCrud!='nuevo'">
                            <label class="col-form-label col-form-label-sm col-md-3">Estado</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" v-model="form.es_activo" :value="form.es_activo">
                                    <label for="customCheckbox2" class="custom-control-label">{{ form.es_activo ==1 ? 'Activo' : 'Inactivo' }}</label>
                                </div>
                                <small class="text-danger" v-for="error in errors.es_activo"
                                    :key="error">{{error }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger" type="button">
                            <i class="fas fa-times"></i> Cerrar
                        </button>
                        <button class="btn btn-success" type="submit" v-if="form.estadoCrud!='mostrar'">
                            <span v-if="form.estadoCrud=='nuevo'">
                                <i class="fas fa-save"></i> Guardar
                            </span>
                            <span v-else-if="form.estadoCrud=='editar'">
                                <i class="fas fa-sync-alt"></i> Actualizar
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { toRefs, onMounted } from 'vue'
import useHelper from '@/Helpers'
import usePandero from '@/Composables/Pandero/panderos'
export default {
    props:{
        form: Object
    },
    emits:['onPanderos'],
    setup(props, {emit}) {

        const { form } = toRefs(props)

        const { Swal, Toast  } = useHelper()

        const {
            respuesta, errors, pandero,
            agregarPandero,
        } = usePandero();

        const agregar = async() => {
            await agregarPandero(form.value)
            if(errors.value)
            {
                form.value.errors = errors.value
            }

            if(respuesta.value.ok==1){
                $('#modal-pandero').modal('hide')
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: respuesta.value.mensaje,
                    showConfirmButton: false,
                    timer: 1500
                })
                emit('onPanderos')
            }
        }

        const guardar = () => {
            switch(form.value.estadoCrud)
            {
                case 'nuevo': agregar(); break;
            }
        }

        return {
            form,
            guardar
        }
    },
}
</script>
