<template>
    <AppLayout
        title="User Notes"
    >
        <div>{{ userNotes }}</div>
    </AppLayout>
</template>

<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from "../../Layouts/AppLayout";

export default defineComponent({
    components: {
        AppLayout,
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
