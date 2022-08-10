<template>
    <q-layout view="hhh lpR fFf">
        <q-header class="bg-primary text-white">
            <q-toolbar>
                <q-toolbar-title>
                    <q-avatar>
                        <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
                    </q-avatar>
                    Title
                </q-toolbar-title>
            </q-toolbar>
        </q-header>

        <q-page-container>
            <slot/>
        </q-page-container>
    </q-layout>
</template>

<script>
export default {
    name: "MainLayout"
}
</script>

<style scoped>

</style>
