<template>
    <app-wrp title="My contacts">
        <q-banner class="bg-grey-3" v-if="!$page.props.items">
        <template v-slot:avatar>
            <q-icon name="forum" color="primary" />
        </template>
        You have no contacts.
        </q-banner>


        <q-list bordered separator v-if="$page.props.items">
            <q-item clickable v-ripple v-for="(item,k) in $page.props.items.data" :key="k">
                <q-item-section avatar @click="$inertia.get(route('chat.user.messages', item))">
                    <q-avatar color="primary" text-color="white" class="q-mr-md">{{item.first_letter}}</q-avatar>
                </q-item-section>

                <q-item-section @click="$inertia.get(route('chat.user.messages', item))">
                    <q-item-label>{{item.name}}</q-item-label>
                    <q-item-label caption>
                        <div><label>gender:</label> {{item.gender.label}}</div>
                        <div><label>location:</label> {{item.country}}, {{item.city}}</div>
                        <div><label>birthday:</label> {{item.birthday}}</div>
                    </q-item-label>
                </q-item-section>

                <q-item-section side top>
                    <post-message :item="item"/>
                </q-item-section>
            </q-item>
        </q-list>
    </app-wrp>
</template>

<script>
import AppWrp from "../../Components/App/AppWrp.vue";
import PostMessage from "../../Components/Post/PostMessage.vue";

export default {
    name: "PageUserContacts",
    components: {PostMessage, AppWrp}
}
</script>

<style scoped>

</style>
