<template>
    <div class="UserAvatarMenu">
        <div class="row">
            <div class="col-8 flex flex-center">
                <div>{{ $user.name }}</div>
            </div>
            <div class="col-4">
                <q-avatar color="red" class="cursor-pointer" text-color="white" icon="person"/>
                <q-menu>
                    <q-list style="min-width: 150px">
                        <q-item clickable v-close-popup :href="route('post.create')">
                            <q-item-section>New post</q-item-section>
                        </q-item>
                        <q-item clickable v-close-popup :href="route('my.posts')">
                            <q-item-section>My posts</q-item-section>
                        </q-item>
                        <q-item clickable v-close-popup :href="route('my.contacts')">
                            <q-item-section>My contacts</q-item-section>
                        </q-item>

                        <q-separator v-if="$hasRole('admin') || $hasRole('moderator')"/>
                        <q-item clickable v-close-popup v-if="$hasRole('admin') || $hasRole('moderator')"
                            :href="route('dashboard.home')"
                        >
                            <q-item-section>Dashboard</q-item-section>
                        </q-item>
                        <q-separator/>

                        <q-item clickable v-close-popup :href="route('logout')">
                            <q-item-section>Logout</q-item-section>
                        </q-item>
                    </q-list>
                </q-menu>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "UserAvatarMenu"
}
</script>

<style lang="scss" scoped>
.UserAvatarMenu {
    width: 200px;
}
</style>
