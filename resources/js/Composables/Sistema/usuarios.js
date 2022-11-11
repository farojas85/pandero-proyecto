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

    const obtenerUsuarios = async(data) => {
        let respuesta = await axios.get('api/usuarios-'+data.show_tipo,{ params: data},config)
        usuarios.value =respuesta.data
    }

    return {
        usuarios, obtenerUsuarios, errors, usuario
    }
}
