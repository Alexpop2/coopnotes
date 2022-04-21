<template>
    <div class="w-full p-3">
        <div class="flex justify-center space-x-4">
            Select Users
        </div>
        <div>
            <v-select
                :options="options"
                v-model="selectedUsers"
                :filterable="false"
                @search="onSearch"
                label="name"
                multiple
                :disabled="selectedUsersDisabled"
                :loading="selectedUsersDisabled"
                @option:selecting="onSelected"
                @option:deselecting="onDeselected"
            >
                <template slot="no-options">
                    type to search users
                </template>
            </v-select>
        </div>
    </div>
</template>

<script>

import {defineComponent} from "vue";
import vSelect from 'vue-select'
import Button from "@/Components/Button";
import axios from "axios";

export default defineComponent({
    data: function () {
      return {
          selectedUsers: [],
          options: [],
          selectedUsersDisabled: true
      }
    },
    components: {
        Button,
        vSelect
    },
    props: {
        users: {
            default: [],
            type: Array
        },
        note: Object
    },
    mounted() {
        this.updateField();
    },
    methods: {
        onSelected(option) {
            this.selectedUsersDisabled = true;
            axios.post(route('api.notes.accessed_users.store', [this.note.id, option.id]))
                .then((res) => {
                    this.updateField();
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        },
        onDeselected(option) {
            this.selectedUsersDisabled = true;
            axios.delete(route('api.notes.accessed_users.destroy', [this.note.id, option.id]))
                .then((res) => {
                    this.updateField();
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        },
        updateField() {
            axios.get(route('api.notes.accessed_users', this.note.id))
                .then((res) => {
                    this.selectedUsers = res.data.data;
                    this.selectedUsersDisabled = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        },
        onSearch(search, loading) {
            if(search.length) {
                loading(true);
                this.search(loading, search, this);
            }
        },
        search: _.debounce((loading, search, vm) => {
            axios.get(`/api/users/${escape(search)}`)
                .then(function (res) {
                    vm.options = res.data.data;
                    loading(false);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        }, 350),
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
    }
});
</script>

<style scoped>

</style>
