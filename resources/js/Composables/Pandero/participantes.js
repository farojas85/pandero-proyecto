import axios from 'axios'
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

export default function useParticipante() {
    const errors = ref([])
    const participante = ref({})
    const participantes = ref([])
    const tipo_documentos = ref([])
    const sexos = ref([])
    const datoPersona = ref({})
    const respuesta= ref('')
    const router = useRouter()

    const config = {
        headers:{
            'Authorization': 'Bearer '+ localStorage.getItem('token-api')
        }
    }

    const obtenerTipoDocumentos = async () => {
        let respuesta = await axios.get('api/tipo-documentos-listar',config)
        tipo_documentos.value = respuesta.data
    }

    const obtenerSexos = async() => {
        let respuesta = await axios.get('api/sexos-listar',config)
        sexos.value = respuesta.data
    }

    const obtenerParticipantes = async(data) => {
        let datos = 'page='+data.page+'&paginacion='+data.paginacion+
                    '&buscar='+data.buscar
        let respuesta = await axios.get('api/participantes-'+data.show_tipo+'?'+datos,config)
        participantes.value =respuesta.data
    }

    const obtenerParticipante = async(id) => {
        let responded = await axios.get('api/participantes-mostrar?id='+id,config)
        participante.value = responded.data
        console.log(participante.value)
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

    const agregarParticipante = async(data) => {
        errors.value = ''
        try {
            let respond = await axios.post('api/participantes',data,config)
            errors.value =''
            respuesta.value = respond.data

        } catch (error) {
            errors.value=""
            if(error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        }

    }

    return {
        errors, participante, participantes, tipo_documentos, sexos, datoPersona,
        respuesta,
        obtenerSexos, obtenerTipoDocumentos, obtenerParticipantes, verificarNumeroDocumento,
        agregarParticipante, obtenerParticipante
    }
}
