<template>
    <component :is="$route.meta.layout">
        <router-view />
    </component>
</template>

<script >
    export default {
        setup() {
        }
    }

</script>
