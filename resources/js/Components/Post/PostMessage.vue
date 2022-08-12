<template>
    <div class="PostMessage">
        <q-btn icon="send" outline class="q-pl-md q-pr-md" label="send message"
               @click="dialog = true"
               dense
               size="sm"/>
        <q-dialog v-model="dialog">
            <q-card>
                <q-card-section class="row items-center q-pb-none">
                    <div class="text-h6">Message to author</div>
                    <q-space/>
                    <q-btn icon="close" flat round dense v-close-popup/>
                </q-card-section>
                <q-card-section style="width: 400px">
                    <post-message-form :item="item" @close="dialog = false"/>
                </q-card-section>
            </q-card>
        </q-dialog>
    </div>
</template>

<script>
import PostMessageForm from "./PostMessageForm.vue";
export default {
    name: "PostMessage",
    components: {PostMessageForm},
    props: {
        item: {
            type: Object,
            default: () =>{}
        },
    },
    data() {
        return {
            dialog: false
        }
    },
}
</script>

<style scoped>

</style>
