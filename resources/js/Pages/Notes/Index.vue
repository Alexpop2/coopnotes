<template>
    <AppLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center my-3">
                    <Button
                        @click="onAddNewNoteClick"
                    >
                        <i class="fa-solid fa-plus"></i> Add new
                    </Button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div
                        v-for="note in userNotes"
                        @click="onNoteClick(note)"
                        class="p-4 bg-yellow-200 h-80 shadow-md hover:shadow-xl transition-all hover:scale-110 cursor-pointer z-0 hover:z-50">
                        <div class="text-ellipsis overflow-hidden">
                            {{ note.content }}
                        </div>
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
import Button from "../../Components/Button";

export default defineComponent({
    components: {
        AppLayout,
        Head,
        Link,
        Button,
    },

    props: {
        userNotes: Array,
    },

    methods: {
        onNoteClick(note) {
            this.$inertia.visit(this.route('notes.edit', note.id));
        },
        onAddNewNoteClick() {
            this.$inertia.visit(this.route('notes.create'));
        }
    }
})
</script>
<style scoped>

</style>
