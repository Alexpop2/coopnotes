<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('notes.index')" class="text-sm text-gray-700 underline">
                Notes
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Register
                </Link>
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:pt-0">
                <svg class="h-16 w-auto text-gray-700 sm:h-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 238.39 238.39"><g id="Layer_2" data-name="Layer 2"><rect x="0.5" y="0.5" width="237.39" height="237.39" rx="5.67" fill="#fff089" stroke="#000" stroke-miterlimit="10"/><line x1="23.47" y1="20.94" x2="214.91" y2="20.94" fill="none" stroke="#000" stroke-miterlimit="10"/><line x1="23.47" y1="223.19" x2="214.91" y2="223.19" fill="none" stroke="#000" stroke-miterlimit="10"/><line x1="23.47" y1="41.55" x2="214.91" y2="41.55" fill="none" stroke="#000" stroke-miterlimit="10"/><line x1="23.47" y1="59.35" x2="214.91" y2="59.35" fill="none" stroke="#000" stroke-miterlimit="10"/><line x1="23.47" y1="79.96" x2="214.91" y2="79.96" fill="none" stroke="#000" stroke-miterlimit="10"/></g><g id="Layer_3" data-name="Layer 3"><text transform="translate(59.94 132.2)" font-size="48" font-family="MyriadPro-Regular, Myriad Pro"><tspan letter-spacing="-0.02em">C</tspan><tspan x="26.83" y="0">OOP</tspan><tspan x="-8.04" y="57.6">N</tspan><tspan x="23.54" y="57.6" letter-spacing="-0.02em">O</tspan><tspan x="55.42" y="57.6" letter-spacing="0em">TES</tspan></text></g></svg>
            </div>

            <div class="mt-8 text-slate-300 text-center">
                <h1 class="text-5xl">Coopnotes</h1>
                <h2 class="text-2xl">Create & share your notes</h2>
            </div>
            <div class="mt-8 text-center">
                <Button
                    @click="onLoginClick"
                >
                    Login
                </Button>
                <Button
                    @click="onRegisterClick"
                    class="ml-4"
                >
                    Register
                </Button>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Button from "@/Components/Button";

    export default defineComponent({
        components: {
            Button,
            Head,
            Link,
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        },

        methods: {
            onLoginClick() {
                this.$inertia.visit(this.route('login'));
            },
            onRegisterClick() {
                this.$inertia.visit(this.route('register'));
            },
        }
    })
</script>
