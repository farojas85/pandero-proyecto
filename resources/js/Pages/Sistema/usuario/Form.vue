<template>
    <form id="form-usuarios" @submit.prevent="guardar">
        <div  class="modal fade" id="modal-usuario" tabindex="-1" role="dialog"
        aria-labelledby="ultraModal-Label" aria-hidden="true">
            <div class="modal-dialog animated bounceInDown modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="modal-title-usuario">Section Settings</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-primary border border-primary">
                                    <div class="card-header">
                                        <h2 class="card-title">Datos Personales</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                                title="Tipo Documento">
                                                Tipo Docum.
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control form-control-sm "
                                                        v-model="form.tipo_documento_id"
                                                        :class="{ 'is-invalid': form.errors.tipo_documento_id }"
                                                        id="tipo_documento_id" @change="cambiarTipo"
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
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="card card-danger border border-danger">
                                <div class="card-header">
                                    <h2 class="card-title">Datos Usuario</h2>
                                </div>
                                <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                                title="Nombre form">
                                                Nombre Usuario
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control form-control-sm"
                                                    v-model="form.name" placeholder="Ingrese Nombre form"
                                                    :class="{ 'is-invalid': form.errors.name }"
                                                    :disabled="form.estadoCrud=='mostrar'" />
                                                <small class="text-danger" v-for="error in form.errors.name" :key="error">{{ error }}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                                title="Correo Electrónico">
                                                Correo Elect.
                                            </label>
                                            <div class="col-md-8">
                                                <input type="email" class="form-control form-control-sm"
                                                    v-model="form.email" placeholder="Ingrese Correo Electrónico"
                                                    :class="{ 'is-invalid': form.errors.email }"
                                                    :disabled="form.estadoCrud=='mostrar'" />
                                                <small class="text-danger" v-for="error in form.errors.email" :key="error">{{ error }}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row" v-if="form.estadoCrud!='mostrar'">
                                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                                title="Contraseña">
                                                Contrase&ntilde;a
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="password" class="form-control" v-model="form.password"
                                                        placeholder="Ingrese Contraseña"
                                                        :class="{ 'is-invalid': form.errors.password }"/>
                                                    <!-- <div class="input-group-append cursor-pointer">
                                                        <span class="input-group-text" >
                                                            <i class="fas fa-eye text-secondary"></i>
                                                        </span>
                                                    </div> -->
                                                </div>
                                                <small class="text-danger" v-for="error in form.errors.password" :key="error">{{ error }}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row" v-if="form.estadoCrud!='mostrar'">
                                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                                title="Confirmar Contraseña">
                                                Confirmar
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="password" class="form-control" v-model="form.password_confirmation"
                                                        placeholder="Confirmar Contraseña"
                                                        :class="{ 'is-invalid': form.errors.password_confirmation }"/>
                                                    <!-- <div class="input-group-append cursor-pointer">
                                                        <span class="input-group-text" >
                                                            <i class="fas fa-eye text-secondary"></i>
                                                        </span>
                                                    </div> -->
                                                </div>
                                                <small class="text-danger" v-for="error in form.errors.password_confirmation" :key="error">{{ error }}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                                title="Roles">
                                                Rol
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control form-control-sm"
                                                        v-model="form.role_id"
                                                        :class="{ 'is-invalid': form.errors.role_id }"
                                                        :disabled="form.estadoCrud=='mostrar'" >
                                                    <option value="">-Seleccionar-</option>
                                                    <option v-for="r in roles" :key="r.id" :value="r.id">
                                                        {{ r.nombre}}
                                                    </option>
                                                </select>
                                                <small class="text-danger" v-for="error in form.errors.role_id" :key="error">{{ error }}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                                title="Estado">
                                                Estado
                                            </label>
                                            <div class="col-md-6">
                                                <input type="checkbox" v-model="form.es_activo"
                                                    :disabled="form.estadoCrud=='mostrar'" :checked="form.es_activo==1" />&nbsp;
                                                <label v-if="form.es_activo" class="col-form-label col-form-label-sm text-success font-weight-bold">
                                                    Activo
                                                </label>
                                                <label v-else class="col-form-label col-form-label-sm text-secondary font-weight-bold">
                                                    Inactivo
                                                </label>
                                            </div>
                                        </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger" type="button">
                            <i class="fas fa-times"></i> Cerrar
                        </button>
                        <button class="btn btn-success" type="submit" v-if="form.estadoCrud!='mostrar'">
                            <span v-if="form.estadoCrud=='nuevo'"><i class="fas fa-save"></i> Guardar</span>
                            <span v-else-if="form.estadoCrud=='editar'"><i class="fas fa-sync-alt"></i> Actualizar</span>
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
import useUsuario from '@/Composables/Sistema/usuarios'
export default {
    props:{
        form: Object
    },
    emits:['onUsuarios'],
    setup(props,{emit}) {

        const { form } = toRefs(props)

        const { Swal  } = useHelper()

        const {
            tipo_documentos, sexos, roles, datoPersona, errors, respuesta,
            obtenerTipoDocumentos, obtenerSexos, obtenerRoles, verificarNumeroDocumento,
            agregarUsuario
        } = useUsuario()

        onMounted(() => {
            obtenerTipoDocumentos()
            obtenerSexos()
            obtenerRoles()
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
            await agregarUsuario(form.value)
            if(errors.value )
            {
                form.value.errors = errors.value
            }

            if(respuesta.value.ok==1){
                $('#modal-usuario').modal('hide')
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: respuesta.value.mensaje,
                    showConfirmButton: false,
                    timer: 1500
                })
                emit('onUsuarios')
            }
        }

        const actualizar = async() => {

        }

        const guardar = () => {
            switch(form.value.estadoCrud)
            {
                case 'nuevo': agregar(); break;
                case 'editar': actualizar(); break;
            }
        }

        return {
            form, tipo_documentos, sexos, roles,
            guardar, obtenerDatoDocumento
        }
    },
}
</script>
