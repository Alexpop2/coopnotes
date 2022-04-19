<template>
    <AppLayout
        title="User Notes"
    >
        <Modal
            :show="optionsOpened"
            @close="optionsOpened = null"
        >
            <Options
                :optionsOpened="optionsOpened"
                @close="optionsOpened = null"
            />
        </Modal>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between my-3">
                    <div class="flex justify-start">
                        <Button
                            @click="onBackClick"
                        >
                            Back
                        </Button>
                    </div>
                    <div class="flex justify-end space-x-4">

                        <Button
                            @click="onOptionsClick"
                        >
                            Options
                        </Button>
                        <Button
                            @click="onSaveClick"
                            :disabled="savingProcessing || errorState"
                        >
                            <i
                                :class="{
                                    '!hidden': !savingProcessing && !savedState,
                                    'fa-circle-notch': savingProcessing,
                                    'animate-spin': savingProcessing,
                                    'fa-circle-check': savedState
                                }"
                                class="fa-solid"
                            />
                            {{ saveButtonText }}
                        </Button>
                    </div>
                </div>
                <div
                    @click="onNoteClick"
                    class="p-4 bg-yellow-200 min-h-screen shadow-md cursor-text"
                >
                    <textarea
                        @input="onInput($event.target)"
                        ref="textAreaBlock"
                        v-model="note.content"
                        class="w-full h-full border-0 bg-transparent shadow-transparent overflow-y-hidden" id="content">
                    </textarea>
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
import Modal from "../../Jetstream/Modal";
import DangerButton from "../../Components/DangerButton";
import axios from "axios";
import Options from "@/Pages/Notes/Options/Options";

export default defineComponent({
    components: {
        Options,
        DangerButton,
        Modal,
        Button,
        AppLayout,
        Head,
        Link,
    },

    props: {
        note: Object,
    },

    data: function() {
        return {
            optionsOpened: false,
            usersAccessedOpened: false,
            savingProcessing: false,
            savedState: false,
            errorState: false,
            textAreaBlock: null,
            savedStatedTimeout: null,
        };
    },

    computed: {
        saveButtonText() {
            return this.errorState ? 'Error' : this.savedState ? 'Saved' : this.savingProcessing ? 'Saving' : 'Save';
        }
    },

    methods: {
        onBackClick() {
          this.$inertia.visit(this.route('notes.index'));
        },
        onOptionsClick() {
            this.optionsOpened = true;
        },
        onUsersAccessedClick() {
            this.usersAccessedOpened = true;
        },
        onInput() {
            this.$refs['textAreaBlock'].style.height = "auto";
            this.$refs['textAreaBlock'].style.height = (this.$refs['textAreaBlock'].scrollHeight) + "px";
        },
        onNoteClick() {
            this.$refs['textAreaBlock'].focus();
        },
        onSaveClick() {
            clearTimeout(this.savedStatedTimeout);
            this.savingProcessing = true;
            this.savedState = false;
            axios.put(route('api.notes.update', this.note.id),{content: this.note.content})
                .then((el) => {
                    if(el.data.status === 'success') {
                        this.savingProcessing = false;
                        this.savedState = true;
                        this.savedStatedTimeout = setTimeout(() => {
                            this.savedState = false;
                        },5000);
                    }
                })
                .catch((er) => {
                    this.savingProcessing = false;
                    this.savedState = false;
                    this.errorState = true;
                })
                .then(() => {
                });
        }
    },

    mounted() {
        this.onInput();
    }
})
</script>
<style scoped>
    textarea {
        box-shadow: none;
        resize: none;
    }
</style>
