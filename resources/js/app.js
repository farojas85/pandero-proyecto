import './bootstrap';

import { createApp, h } from 'vue';
import router from './Router'
import App from '@/Pages/App.vue'
import Auth from '@/Auth'
import  SweetAlert2 from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css'

const app = createApp(App)

app.use(router)
app.provide('auth', new Auth(localStorage.getItem('user-logged')))
app.provide('Swal',SweetAlert2)
app.mount('#wrapper')
