<template>
    <div class="w-full p-3">
        <div class="flex justify-center space-x-4">
            <Button
                @click="$emit('pageChanged', 'usersAccessed')"
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
</template>

<script>

import {defineComponent} from "vue";
import Button from "../../../Components/Button";
import DangerButton from "../../../Components/DangerButton";

export default defineComponent({
    components: {
        DangerButton,
        Button
    }
});
</script>

<style scoped>

</style>
