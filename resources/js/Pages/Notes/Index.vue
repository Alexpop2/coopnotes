<template>
    <Head title="User Notes"></Head>

    <div>{{ userNotes }}</div>
</template>

<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Head,
        Link,
    },

    props: {
        userNotes: Array,
    }
})
</script>
<style scoped>

</style>
