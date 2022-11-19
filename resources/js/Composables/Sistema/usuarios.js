import axios from 'axios'
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

export default function useUsuario() {
    const errors = ref([])
    const usuario = ref({})
    const usuarios = ref([])
    const tipo_documentos = ref([])
    const sexos = ref([])
    const roles = ref([])
    const datoPersona = ref({})
    const respuesta= ref('')
    const router = useRouter()

    const config = {
        headers:{
            'Authorization': 'Bearer '+ localStorage.getItem('token-api')
        }
    }

    const verificarNumeroDocumento = async(datos) => {
        errors.value = []
        try {

            let respuesta = await axios.post('api/verificar-numero-documento',datos,config)
            datoPersona.value = respuesta.data
        }
        catch (error) {
            errors.value=""
            if(error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        }
    }

    const obtenerUsuarios = async(data) => {
        let datos = 'page='+data.page+'&paginacion='+data.paginacion+
                    '&buscar='+data.buscar
        let respuesta = await axios.get('api/usuarios-'+data.show_tipo+'?'+datos,config)
        usuarios.value =respuesta.data
    }

    const obtenerTipoDocumentos = async () => {
        let respuesta = await axios.get('api/tipo-documentos-listar',config)
        tipo_documentos.value = respuesta.data
    }

    const obtenerSexos = async() => {
        let respuesta = await axios.get('api/sexos-listar',config)
        sexos.value = respuesta.data
    }

    const obtenerRoles = async() => {
        let respuesta = await axios.get('api/roles-listar',config)
        roles.value = respuesta.data
    }

    const agregarUsuario = async(data) => {
        errors.value = ''
        try {
            let respond = await axios.post('api/usuarios',data,config)
            errors.value =''
            respuesta.value = respond.data

        } catch (error) {
            errors.value=""
            if(error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        }

    }

    const mostrarUsuario = async(id) => {
        return(await axios.get('/api/usuario-mostrar',{ params: {id:id}})).data
    }

    const actualizarUsuario = async(datos) => {
        return (await axios.put('/api/usuario'))
    }

    return {
        usuarios, errors, usuario, tipo_documentos, sexos, roles, datoPersona,
        respuesta,
        obtenerUsuarios, verificarNumeroDocumento, agregarUsuario, mostrarUsuario,
        actualizarUsuario, obtenerTipoDocumentos, obtenerSexos, obtenerRoles
    }
}
