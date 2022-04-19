<template>
    <div class="w-full p-3 text-right text-2xl">
        <i
            @click="$emit('close')"
            class="fa-solid fa-xmark text-gray-500 cursor-pointer"
        />
    </div>
    <div
        class="h-96"
    >
        <TransitionGroup
            name="fade"
        >
            <OptionsMain
                v-if="page === 'main'"
                @pageChanged="onPageChanged"
            />
            <OptionsUsersAccessed
                v-if="page === 'usersAccessed'"
            />
        </TransitionGroup>
    </div>
</template>

<script>

import {defineComponent} from "vue";
import OptionsMain from "@/Pages/Notes/Options/OptionsMain";
import OptionsUsersAccessed from "@/Pages/Notes/Options/OptionsUsersAccessed";

export default defineComponent({
    components: {
        OptionsUsersAccessed,
        OptionsMain
    },
    props: {
        optionsOpened: Boolean
    },
    data: function () {
        return {
            page: 'main',
        }
    },
    methods: {
        onPageChanged(page) {
            this.page = page;
        }
    },
    emits: ['close'],
});
</script>

<style scoped>

</style>
