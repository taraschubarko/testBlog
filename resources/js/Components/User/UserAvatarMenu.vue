<template>
    <div class="UserAvatarMenu">
        <q-avatar color="red" class="cursor-pointer" text-color="white" icon="person"/>
        <q-menu>
            <q-list style="min-width: 100px">
                <q-item clickable v-close-popup>
                    <q-item-section>New post</q-item-section>
                </q-item>
                <q-item clickable v-close-popup :href="route('my.posts')">
                    <q-item-section>My posts</q-item-section>
                </q-item>
                <q-item clickable v-close-popup :href="route('logout')">
                    <q-item-section>Logout</q-item-section>
                </q-item>
            </q-list>
        </q-menu>
    </div>
</template>

<script>
export default {
    name: "UserAvatarMenu"
}
</script>

<style scoped>

</style>
