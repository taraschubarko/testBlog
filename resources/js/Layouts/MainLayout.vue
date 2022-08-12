<template>
    <q-layout view="hhh lpR fFf">
        <q-header class="bg-primary text-white">
            <q-toolbar>
                <q-toolbar-title>
                    <app-link :href="route('home')">
                        <q-avatar>
                            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
                        </q-avatar>
                    </app-link>
                    Blog
                </q-toolbar-title>
                <div class="sig" v-if="!$user">
                    <q-icon name="login" size="24px" class="q-mr-md"/>
                    <app-link label="Sign In" :href="route('login')"/> /
                    <app-link label="Sign Up" :href="route('register')"/>
                </div>
                <q-btn v-if="$user" round flat dense icon="notifications" :href="route('message.index')">
                    <q-badge v-if="$newNotify" floating color="red" rounded :label="$newNotify" />
                </q-btn>
                <user-avatar-menu v-if="$user"/>
            </q-toolbar>
        </q-header>

        <q-page-container>
            <slot/>
        </q-page-container>
    </q-layout>
</template>

<script>
import AppLink from "../Components/App/AppLink.vue";
import UserAvatarMenu from "../Components/User/UserAvatarMenu.vue";
export default {
    name: "MainLayout",
    components: {UserAvatarMenu, AppLink}
}
</script>

<style scoped>

</style>
