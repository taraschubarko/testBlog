<template>
    <q-layout view="hhh lpR fFf">
        <q-header class="bg-primary text-white">
            <q-toolbar>
                <q-toolbar-title>
                    <q-avatar>
                        <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
                    </q-avatar>
                    Blog
                </q-toolbar-title>
                <div class="sig">
                    <q-icon name="login" size="24px" class="q-mr-md"/>
                    <app-link label="Sign In" href="/auth/signIn"/> /
                    <app-link label="Sign Up" href="/auth/signUp"/>
                </div>
            </q-toolbar>
        </q-header>

        <q-page-container>
            <slot/>
        </q-page-container>
    </q-layout>
</template>

<script>
import AppLink from "../Components/App/AppLink.vue";
export default {
    name: "MainLayout",
    components: {AppLink}
}
</script>

<style scoped>

</style>
