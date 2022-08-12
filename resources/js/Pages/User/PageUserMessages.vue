<template>
    <app-wrp title="My messages">
        <q-banner class="bg-grey-3" v-if="!$page.props.items.data.length">
            <template v-slot:avatar>
                <q-icon name="forum" color="primary" />
            </template>
            You have no messages.
        </q-banner>
        <div class="msgs" v-if="$page.props.items.data.length">
            <q-chat-message
                v-for="(item,k) in $page.props.items.data"
                :key="k"
                :name="item.user.name"
                avatar="https://cdn.quasar.dev/img/avatar2.jpg"
                bg-color="grey-4"
            >
                <template v-slot:avatar>
                    <q-avatar color="primary" text-color="white" class="q-mr-md">{{item.user.first_letter}}</q-avatar>
                </template>
                <template v-slot:default>
                    <div class="q-pa-sm" >
                        <div class="row q-mb-sm">
                            <div class="col-8">
                                <q-badge rounded color="red" label="new" v-if="!item.read_at" />
                            </div>
                            <div class="col-4 text-right">
                                <small class="text-grey-6">{{item.created_at}}</small>
                            </div>
                        </div>
                        <div>
                            {{item.message}}
                        </div>
                        <div class="bottom q-mt-md" v-if="!item.read_at">
                            <q-btn label="mark as read" size="sm" outline :href="route('message.read', item.id)"/>
                        </div>
                    </div>
                </template>
            </q-chat-message>
            <div class="flex flex-center q-mt-md">
                <app-paginate :last_page="$page.props.items.meta.last_page"/>
            </div>
        </div>
    </app-wrp>
</template>

<script>
import AppWrp from "../../Components/App/AppWrp.vue";
import AppPaginate from "../../Components/App/AppPaginate.vue";

export default {
    name: "PageUserMessages",
    components: {AppPaginate, AppWrp}
}
</script>

<style scoped>

</style>
