<template>
    <form id="form-usuarios" @submit.prevent="guardar">
        <div  class="modal" id="modal-usuario" tabindex="-1" role="dialog"
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
                                <section class="box primary">
                                    <header class="panel_header ui-sortable-handle">
                                        <h2 class="title float-left">Datos Personales</h2>
                                    </header>
                                    <div class="content-body">
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
                                                    <option v-for="t in tipoDocumentos" :key="t.id" :value="t.id">
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
                                                    id="numero_documento" @change="verificarNumeroDocumento"
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
                                </section>
                            </div>
                            <div class="col-md-6">
                            <section class="box purple">
                                <header class="panel_header ui-sortable-handle">
                                    <h2 class="title float-left">Datos form</h2>
                                </header>
                                <div class="content-body">
                                        <div class="form-group row">
                                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                                title="Nombre form">
                                                form
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
                                                    <div class="input-group-append cursor-pointer">
                                                        <span class="input-group-text" >
                                                            <i class="fas fa-eye text-secondary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <small class="text-danger" v-for="error in form.errors.password" :key="error">{{ error }}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row" v-if="form.estadoCrud!='mostrar'">
                                            <label class="col-form-label col-form-label-sm col-md-3 font-weight-bold"
                                                title="Confirmar Contraseña">
                                                Confirma Contrase&ntilde;a
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="password" class="form-control" v-model="form.password_confirmation"
                                                        placeholder="Ingrese Contraseña"
                                                        :class="{ 'is-invalid': form.errors.password_confirmation }"/>
                                                    <div class="input-group-append cursor-pointer">
                                                        <span class="input-group-text" >
                                                            <i class="fas fa-eye text-secondary"></i>
                                                        </span>
                                                    </div>
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
                                                <input type="checkbox" v-model="form.activo"
                                                    :disabled="form.estadoCrud=='mostrar'" />&nbsp;
                                                <label v-if="form.activo" class="col-form-label col-form-label-sm text-success font-weight-bold">
                                                    Activo
                                                </label>
                                                <label v-else class="col-form-label col-form-label-sm text-secondary font-weight-bold">
                                                    Inactivo
                                                </label>
                                            </div>
                                        </div>
                                </div>
                                </section>
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
import { toRefs } from 'vue'
export default {
    props:{
        form: Object
    },
    emits:['onUsuarios'],
    setup(props,{emit}) {

        const { form } = toRefs(props)

        const guardar = () => {

        }

        return {
            form,
            guardar
        }
    },
}
</script>
