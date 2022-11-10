<template>
    <pre-loader></pre-loader>
    <nav-bar></nav-bar>
    <sidebar></sidebar>
    <div class="content-wrapper">
        <router-view></router-view>
    </div>
    <!-- <Footer />
    <Aside /> -->
</template>


<script>
import { onMounted } from 'vue'
import useHelper from '@/Helpers'
import PreLoader from '@/Components/Partials/PreLoader.vue'
import Sidebar from '@/Components/Partials/SideBar.vue'
import NavBar from '@/Components/Partials/NavBar.vue'
export default {
    components:{
        PreLoader, Sidebar, NavBar
    },
    setup() {

    },
}
</script>
<script setup>

    const { cargarClasesDefaultLayout } = useHelper()

    onMounted(() => {
        cargarClasesDefaultLayout()
    })
</script>
