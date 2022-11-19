import axios from 'axios'
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

export default function usepandero() {
    const errors = ref([])
    const pandero = ref({})
    const panderos = ref([])
    const respuesta= ref('')
    const router = useRouter()

    const config = {
        headers:{
            'Authorization': 'Bearer '+ localStorage.getItem('token-api')
        }
    }

    const obtenerPanderos = async(data) => {
        let datos = 'page='+data.page+'&paginacion='+data.paginacion+
                    '&buscar='+data.buscar
        let respuesta = await axios.get('api/panderos-'+data.show_tipo+'?'+datos,config)
        panderos.value =respuesta.data
    }

    const agregarPandero = async(data) => {
        errors.value = ''
        try {
            let responsed = await axios.post('api/panderos',data,config)

            errors.value = ''
            if(responsed.data.ok==1)
            {
                respuesta.value = responsed.data
            }
        }
        catch (error) {
            errors.value=""
            if(error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        }
    }

    return {
        errors, panderos, pandero, respuesta,
        obtenerPanderos, agregarPandero
    }
}
