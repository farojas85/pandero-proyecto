import axios from 'axios'
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

export default function useUsuario() {
    const errors = ref([])
    const usuario = ref({})
    const usuarios = ref([])
    const datoPersona = ref({})
    const usuRespuesta= ref('')
    const router = useRouter()

    const config = {
        headers:{
            'Authorization': 'Bearer '+ localStorage.getItem('token-api')
        }
    }

    const verificarNumeroDocumento = async(datos) => {
        return (await axios.post('/api/verificar-numero-documento',datos)).data
    }

    const obtenerUsuarios = async(data) => {
        let datos = 'page='+data.page+'&paginacion='+data.paginacion+
                    '&buscar='+data.buscar
        let respuesta = await axios.get('api/usuarios-'+data.show_tipo+'?'+datos,config)
        usuarios.value =respuesta.data
    }

    const guardarUsuario = async(datos) => {
        return (await axios.post('/api/usuarios',datos)).data
    }

    const mostrarUsuario = async(id) => {
        return(await axios.get('/api/usuario-mostrar',{ params: {id:id}})).data
    }

    const actualizarUsuario = async(datos) => {
        return (await axios.put('/api/usuario'))
    }

    return {
        usuarios, errors, usuario,
        obtenerUsuarios, verificarNumeroDocumento, guardarUsuario, mostrarUsuario,
        actualizarUsuario
    }
}
