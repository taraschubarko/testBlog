<template>
    <app-head title="My Posts"/>
    <main-layout>
        <q-page padding>
            <q-breadcrumbs active-color="primary" class="q-mb-lg">
                <q-breadcrumbs-el label="Home" icon="home" :href="route('home')" />
                <q-breadcrumbs-el label="My Posts" icon="widgets" />
            </q-breadcrumbs>
            <q-table
                :rows="$page.props.items.data"
                hide-pagination
                :rows-per-page-options="[0]"
            >
                <template v-slot:header>
                    <q-tr>
                        <q-th style="width: 20px">#</q-th>
                        <q-th>Name</q-th>
                        <q-th>Type</q-th>
                        <q-th>Status</q-th>
                        <q-th>Created</q-th>
                        <q-th>Action</q-th>
                    </q-tr>
                </template>
                <template v-slot:body="props">
                    <q-tr>
                        <q-td>{{ props.row.id }}</q-td>
                        <q-td>{{ props.row.name }}</q-td>
                        <q-td class="text-center">
                            <q-badge :class="`badge-${props.row.type}`" rounded :label="props.row.type" />
                        </q-td>
                        <q-td class="text-center">
                            <q-badge :class="`badge-${props.row.status}`" rounded :label="props.row.status" />
                        </q-td>
                        <q-td class="text-center">{{ formatDate(props.row.created_at, 'DD.MM.YYYY') }}</q-td>
                        <q-td class="text-right">
                            <q-btn icon="edit" flat round dense size="sm" class="q-mr-sm" :href="route('post.edit', props.row)"/>
                            <q-btn icon="delete" color="red" flat round dense size="sm" :href="route('post.destroy', props.row)"/>
                        </q-td>
                    </q-tr>
                </template>
            </q-table>
            <div class="q-pa-lg flex flex-center" v-if="$page.props.items.last_page > 1">
                <q-pagination
                    v-model="$page.props.items.current_page"
                    :max="$page.props.items.last_page"
                    :max-pages="6"
                    boundary-numbers
                />
            </div>
        </q-page>
    </main-layout>
</template>

<script>
import AppHead from "../../Components/App/AppHead.vue";
import MainLayout from "../../Layouts/MainLayout.vue";
import { date } from 'quasar'

export default {
    name: "PageUserPosts",
    components: {MainLayout, AppHead},

    methods: {
        formatDate(val) {
            return date.formatDate(val, 'DD.MM.YYYY');
        }
    },

    // watch: {
    //     '$page.props.items.current_page': function (newValue, oldValue) {
    //         this.$inertia.get(route('my.posts'), {page: newValue});
    //     }
    // },
}
</script>

<style scoped>

</style>
