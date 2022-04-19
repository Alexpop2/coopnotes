<template>
    <div class="w-full p-3">
        <div class="flex justify-center space-x-4">
            Select Users
        </div>
        <div>
            <v-select
                :options="users"
                v-model="selectedUsers"
                :filterable="false"
                @search="onSearch"
                label="name"
                multiple
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

export default defineComponent({
    data: function () {
      return {
          selectedUsers: []
      }
    },
    components: {
        vSelect
    },
    props: {
        users: {
            default: [
                {id: 1, name: 'test'},
                {id: 2, name: 'test'},
                {id: 3, name: 'test'},
                {id: 4, name: 'test'},
                {id: 5, name: 'test'},
            ],
            type: Array
        }
    },
    methods: {
        onSearch(search, loading) {
            if(search.length) {
                loading(true);
                this.search(loading, search, this);
            }
        },
        search: _.debounce((loading, search, vm) => {
            axios.get(`/api/users/${escape(search)}`)
                .then(function (res) {
                    vm.options = res.data;
                    loading(false);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        }, 350)
    }
});
</script>

<style scoped>

</style>
