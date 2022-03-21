<template>
    <button
        class="rounded border-2 border-cyan-500 text-cyan-500 p-3 uppercase hover:text-white hover:bg-cyan-500 transition-all disabled:border-gray-400 disabled:text-gray-400 disabled:bg-transparent">
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
