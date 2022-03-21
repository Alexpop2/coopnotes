<template>
    <button
        class="rounded border-2 border-red-500 text-red-500 p-3 uppercase hover:text-white hover:bg-red-500 transition-all">
        <slot />
    </button>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
})
</script>
<style scoped>

</style>
