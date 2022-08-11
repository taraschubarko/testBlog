<template>
    <div class="UserAvatarMenu">
        <div class="row">
            <div class="col-8 flex flex-center">
                <div>{{$user.name}}</div>
            </div>
            <div class="col-4">
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
        </div>


    </div>
</template>

<script>
export default {
    name: "UserAvatarMenu"
}
</script>

<style lang="scss" scoped>
.UserAvatarMenu{
    width: 200px;
}
</style>
