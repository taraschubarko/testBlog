<template>
    <q-layout view="lHh lpR lFf">

        <q-header class="bg-grey-10 text-white">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleLeftDrawer"/>

                <q-toolbar-title>
                    <q-avatar>
                        <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
                    </q-avatar>
                    Dashboard
                </q-toolbar-title>
            </q-toolbar>
        </q-header>

        <q-drawer class="bg-grey-9 text-white" show-if-above v-model="leftDrawerOpen" side="left">
            <admin-menu/>
        </q-drawer>

        <q-page-container>
            <slot/>
        </q-page-container>

    </q-layout>
</template>

<script>
import {ref} from 'vue'
import AdminMenu from "../Components/Admin/AdminMenu.vue";

export default {
    components: {AdminMenu},
    setup() {
        const leftDrawerOpen = ref(false)

        return {
            leftDrawerOpen,
            toggleLeftDrawer() {
                leftDrawerOpen.value = !leftDrawerOpen.value
            }
        }
    }
}
</script>
