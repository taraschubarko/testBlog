<template>
    <q-card class="my-card q-mb-lg" flat bordered>
        <q-card-section horizontal>
            <q-card-section class="q-pt-xs">
                <div class="text-h5 q-mt-sm q-mb-xs">
                    <app-link :label="item.name" :href="route('post.show', item)"/>
                </div>
                <div class="text-caption text-grey">{{item.text}}</div>
                <div class="row q-mt-lg">
                    <div class="col-2">
                        <q-avatar>
                            <img src="https://cdn.quasar.dev/img/boy-avatar.png">
                        </q-avatar>
                    </div>
                    <div class="col-10">
                        <small class="text-grey-5">Author</small>
                        <div class="q-mb-md">{{item.user.name}}</div>
                        <q-btn icon="send" outline class="q-pl-md q-pr-md" label="send message" dense size="sm"/>
                    </div>
                </div>
            </q-card-section>

            <q-card-section class="col-5 flex flex-center">
                <q-img
                    class="rounded-borders"
                    :src="`/images/medium/${item.image.path}`"
                />
            </q-card-section>
        </q-card-section>

        <q-separator/>

        <q-card-actions>
            <q-btn flat round icon="event"/>
            <q-btn flat>{{item.created_at}}</q-btn>
            <q-btn flat color="primary">{{item.type}}</q-btn>
        </q-card-actions>
    </q-card>
</template>

<script>
import AppLink from "../App/AppLink.vue";
export default {
    name: "BlogItem",
    components: {AppLink},
    props: {
        item: {
            type: Object,
            default: () => {
            }
        },
    },
}
</script>

<style scoped>

</style>
