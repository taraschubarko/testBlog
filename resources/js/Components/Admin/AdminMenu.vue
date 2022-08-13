<template>
    <q-list bordered padding class="rounded-borders">
        <q-item
            clickable
            v-ripple
            :href="route('home')"
        >
            <q-item-section avatar>
                <q-icon name="inbox"/>
            </q-item-section>
            <q-item-section>Site</q-item-section>
        </q-item>

        <q-item
            clickable
            v-ripple
            :href="route('dashboard.posts.index')"
        >
            <q-item-section avatar>
                <q-icon name="description"/>
            </q-item-section>

            <q-item-section>Posts</q-item-section>
        </q-item>

        <q-item
            clickable
            v-ripple
            :href="route('dashboard.users.index')"
        >
            <q-item-section avatar>
                <q-icon name="people_alt"/>
            </q-item-section>

            <q-item-section>Users</q-item-section>
        </q-item>

        <q-separator spaced/>

        <q-item
            clickable
            v-ripple

        >
            <q-item-section avatar>
                <q-icon name="settings"/>
            </q-item-section>

            <q-item-section>Settings</q-item-section>
        </q-item>

        <q-item
            clickable
            v-ripple
            :href="route('logout')"
        >
            <q-item-section avatar>
                <q-icon name="logout"/>
            </q-item-section>

            <q-item-section>Logout</q-item-section>
        </q-item>
    </q-list>
</template>

<script>
export default {
    name: "AdminMenu"
}
</script>

<style scoped>

</style>
