<template>
    <AppLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div
                        v-for="note in userNotes"
                        class="p-4 bg-yellow-200 h-80 shadow-md hover:shadow-xl transition-all hover:scale-110 cursor-pointer z-0 hover:z-50 text-ellipsis overflow-hidden">
                        {{ note.content }}
                    </div>
                </div>
            </div>
        </div>
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
