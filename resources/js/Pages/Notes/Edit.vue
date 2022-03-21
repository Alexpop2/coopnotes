<template>
    <AppLayout
        title="User Notes"
    >
        <Modal
            :show="optionsOpened"
            @close="optionsOpened = null"
        >
            <div class="w-full p-3 text-right text-2xl">
                <i
                    @click="optionsOpened = null"
                    class="fa-solid fa-xmark text-gray-500 cursor-pointer"
                />
            </div>
            <div class="w-full p-3">
                <div class="flex justify-center space-x-4">
                    <Button
                        @click="optionsOpened = null"
                    >
                        Users accessed
                    </Button>
                    <DangerButton
                        @click="optionsOpened = null"
                    >
                        Delete
                    </DangerButton>
                </div>
            </div>
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
                            :disabled="savingProcessing"
                        >
                            <i
                                :class="{'!hidden': !savingProcessing}"
                                class="fa-solid fa-circle-notch animate-spin"
                            />
                            {{ saveButtonText }}
                        </Button>
                    </div>
                </div>
                <div
                    @click="onNoteClick($event.target)"
                    class="p-4 bg-yellow-200 min-h-screen shadow-md cursor-text"
                >
                    <textarea
                        @input="onInput($event.target)"
                        class="w-full h-full border-0 bg-transparent shadow-transparent overflow-y-hidden" id="content">{{ note.content }}</textarea>
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

export default defineComponent({
    components: {
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
            savingProcessing: false,
        };
    },

    computed: {
        saveButtonText() {
            return this.savingProcessing ? 'Saving' : 'Save';
        }
    },

    methods: {
        onBackClick() {
          this.$inertia.visit(this.route('notes.index'));
        },
        onOptionsClick() {
            this.optionsOpened = true;
        },
        onInput(element) {
            element.style.height = "auto";
            element.style.height = (element.scrollHeight) + "px";
        },
        onNoteClick(element) {
            element.querySelector('textarea').focus();
        },
        onSaveClick() {
            this.savingProcessing = true;
        }
    }
})
</script>
<style scoped>
    textarea {
        box-shadow: none;
        resize: none;
    }
</style>
