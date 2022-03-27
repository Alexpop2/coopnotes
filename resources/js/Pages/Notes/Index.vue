<template>
    <AppLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    v-if="showAddButton"
                    class="flex justify-center my-3"
                >
                    <Button
                        @click="onAddNewNoteClick"
                    >
                        <i class="fa-solid fa-plus"></i> Add new
                    </Button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div
                        v-for="note in userNotesData"
                        @click="onNoteClick(note)"
                        class="p-4 bg-yellow-200 h-80 shadow-md hover:shadow-xl transition-all md:hover:scale-110 cursor-pointer z-0 hover:z-50 relative">
                        <div class="text-ellipsis overflow-hidden whitespace-pre-wrap h-full">
                            {{ note.content }}
                        </div>
                        <div
                            v-if="sharedMode && !note.approved"
                            class="absolute w-full h-full left-0 top-0 backdrop-blur-md bg-white/30 flex"
                        >
                            <div class="my-auto flex justify-around w-full">
                                <Button
                                    @click="onNoteApproveClick(note)"
                                >
                                    Approve
                                </Button>
                                <DangerButton
                                    @click="onNoteDeclineClick(note)"
                                >
                                    Decline
                                </DangerButton>
                            </div>
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
import DangerButton from "../../Components/DangerButton";
import axios from "axios";

export default defineComponent({
    components: {
        DangerButton,
        AppLayout,
        Head,
        Link,
        Button,
    },

    props: {
        userNotes: Array,
        showAddButton: {
            default: false,
            type: Boolean
        },
        sharedMode: {
            default: false,
            type: Boolean
        },
    },

    data () {
        return {
            userNotesData: this.userNotes,
        }
    },

    methods: {
        onNoteClick(note) {
            if(!this.sharedMode || note.approved) {
                this.$inertia.visit(this.route('notes.edit', note.id));
            }
        },
        onAddNewNoteClick() {
            this.$inertia.visit(this.route('notes.create'));
        },
        onNoteApproveClick(note) {
            axios.put(route('api.notes.shared.update', {note: note.id, shared: note.shared_id}), {approved: true})
                .then(() => {
                    this.getUpdatedUserSharedNotes();
                });
        },
        onNoteDeclineClick(note) {
            axios.delete(route('api.notes.shared.destroy', {note: note.id, shared: note.shared_id}))
                .then(() => {
                    this.getUpdatedUserSharedNotes();
                });
        },
        getUpdatedNotes(route) {
            axios.get(this.route(route))
                .then((data) => {
                    this.userNotesData = data.data.data;
                })
        },
        getUpdatedUserNotes() {
            this.getUpdatedNotes('api.notes.index');
        },
        getUpdatedUserSharedNotes() {
            this.getUpdatedNotes('api.notes.shared.index');
        }
    },

    mounted() {
    }
})
</script>
<style scoped>

</style>
