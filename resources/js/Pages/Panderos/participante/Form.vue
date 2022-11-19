<template>
    <form id="form-participantes" @submit.prevent="guardar">
        <div  class="modal fade" id="modal-participante" tabindex="-1" role="dialog"
        aria-labelledby="ultraModal-Label" aria-hidden="true">
            <div class="modal-dialog animated bounceInDown">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="modal-title-participante">Section Settings</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                title="Tipo Documento">
                                Tipo Docum.
                            </label>
                            <div class="col-md-6">
                                <select class="form-control form-control-sm "
                                        v-model="form.tipo_documento_id"
                                        :class="{ 'is-invalid': form.errors.tipo_documento_id }"
                                        id="tipo_documento_id"
                                        :disabled="form.estadoCrud=='mostrar'">
                                    <option value="">-Seleccionar-</option>
                                    <option v-for="t in tipo_documentos" :key="t.id" :value="t.id"
                                        :title="t.nombre_largo">
                                        {{ t.nombre_corto}}
                                    </option>
                                </select>
                                <small class="text-danger" v-for="error in form.errors.tipo_documento_id" :key="error">{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                title="Número Documento">
                                N&uacute;mero Doc.
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm"
                                    v-model="form.numero_documento" placeholder="Ingrese Número de Documento" maxlength="15"
                                    :class="{ 'is-invalid': form.errors.numero_documento }"
                                    id="numero_documento" @change="obtenerDatoDocumento"
                                    :disabled="form.estadoCrud=='mostrar'"/>
                                    <small class="text-danger" v-for="error in form.errors.numero_documento" :key="error">{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                title="Nombres">
                                Nombres
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm"
                                    v-model="form.nombres" placeholder="Ingrese Nombres"
                                    :class="{ 'is-invalid': form.errors.nombres }"
                                    id="nombres"
                                    :disabled="form.estadoCrud=='mostrar'"/>
                                <small class="text-danger" v-for="error in form.errors.nombres" :key="error">{{ error }}</small>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                title="Apellido Paterno">
                                Ape. Paterno
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm"
                                    v-model="form.apellido_paterno" id="apellido_paterno"
                                    placeholder="Ingrese Apellido Paterno"
                                    :disabled="form.estadoCrud=='mostrar'" />

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                title="Apellido Materno">
                                Ape Materno
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm"
                                    v-model="form.apellido_materno" id="apellido_materno"
                                    placeholder="Ingrese Apellido Materno"
                                    :disabled="form.estadoCrud=='mostrar'" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                title="Sexo">
                                Sexo
                            </label>
                            <div class="col-md-6">
                                <select class="form-control form-control-sm"
                                        v-model="form.sexo_id"
                                        :class="{ 'is-invalid': form.errors.sexo_id }"
                                        :disabled="form.estadoCrud=='mostrar'">
                                    <option value="">-Seleccionar-</option>
                                    <option v-for="s in sexos" :key="s.id" :value="s.id">
                                        {{ s.nombre}}
                                    </option>
                                </select>
                                <small class="text-danger" v-for="error in form.errors.sexo_id" :key="error">{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                title="Dirección">
                                Direcci&oacute;n
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm"
                                    v-model="form.direccion" placeholder="Ingrese Dirección"
                                    :disabled="form.estadoCrud=='mostrar'" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                title="Teléfono">
                                Tel&eacute;fono
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm"
                                    v-model="form.telefono" placeholder="Ingrese Teléfono"
                                    :disabled="form.estadoCrud=='mostrar'"/>
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
import useParticipante from '@/Composables/Pandero/participantes'

export default {
    props:{
        form: Object
    },
    emits:['onParticipantes'],
    setup(props, { emit }) {

        const { form } = toRefs(props)

        const { Swal, Toast  } = useHelper()

        const {
            tipo_documentos, sexos, datoPersona, errors, respuesta,
            participante,
            obtenerTipoDocumentos, obtenerSexos,  verificarNumeroDocumento,
            agregarParticipante, obtenerParticipante
        } = useParticipante()


        onMounted(() => {
            obtenerTipoDocumentos()
            obtenerSexos()
        })

        const obtenerDatoDocumento = async () => {
            await verificarNumeroDocumento(form.value)
            if(errors.value)
            {
                form.value.errors = errors.value
            }
            if(datoPersona.value)
            {
                switch(datoPersona.value.tipo)
                {
                    case 0:
                        form.value.nombres = datoPersona.value.nombres
                        form.value.apellido_paterno = datoPersona.value.apellido_paterno
                        form.value.apellido_materno = datoPersona.value.apellido_materno
                        form.value.sexo_id = datoPersona.value.sexo_id
                        form.value.telefono = datoPersona.value.telefono
                        form.value.direccion = datoPersona.value.direccion
                        ; break;
                    case 1:
                        form.value.nombres = datoPersona.value.nombres
                        form.value.apellido_paterno = datoPersona.value.apellidoPaterno
                        form.value.apellido_materno = datoPersona.value.apellidoMaterno
                        ; break;
                    case 2:
                        form.value.nombres = datoPersona.value.razonSocial
                        ; break;
                }
            }
        }

        const agregar = async() => {
            await agregarParticipante(form.value)
            if(errors.value)
            {
                form.value.errors = errors.value
            }

            if(respuesta.value.ok==1){
                $('#modal-participante').modal('hide')
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: respuesta.value.mensaje,
                    showConfirmButton: false,
                    timer: 1500
                })
                emit('onParticipantes')
            }
        }

        const guardar = () => {
            switch(form.value.estadoCrud)
            {
                case 'nuevo': agregar(); break;
            }
        }

        return {
            form, tipo_documentos, sexos,
            obtenerDatoDocumento, guardar
        }
    },
}
</script>
