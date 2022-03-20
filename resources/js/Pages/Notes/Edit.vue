<template>
    <AppLayout
        title="User Notes"
    >
        <div>{{ note }}</div>
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
        note: Object,
    }
})
</script>
<style scoped>

</style>
