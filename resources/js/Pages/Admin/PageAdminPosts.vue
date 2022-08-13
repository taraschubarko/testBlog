<template>
    <admin-wrp title="Posts">
        <template v-slot:name>- Posts</template>
        <template v-slot:subh>
            <q-bar class="bg-primary">
                <q-btn label="Create post" icon="add" flat class="text-white"/>
            </q-bar>
        </template>
        <q-table class="no-border-radius"
                 :rows="$page.props.items.data"
                 hide-pagination
                 :rows-per-page-options="[0]"
        >
            <template v-slot:header>
                <q-tr>
                    <q-th>#</q-th>
                    <q-th>Post name</q-th>
                    <q-th>Type</q-th>
                    <q-th>Status</q-th>
                    <q-th>Created</q-th>
                    <q-th>Author</q-th>
                    <q-th>Actions</q-th>
                </q-tr>
            </template>
            <template v-slot:body="props">
                <q-tr>
                    <q-td>{{ props.row.id }}</q-td>
                    <q-td>
                        <app-link :href="route('post.show', props.row)" :label="props.row.name"/>
                    </q-td>
                    <q-td>
                        <q-badge :class="`badge-${props.row.type}`" rounded :label="props.row.type"/>
                    </q-td>
                    <q-td>
                        <q-badge :class="`badge-${props.row.status}`" rounded :label="props.row.status"/>
                    </q-td>
                    <q-td>
                        {{ props.row.created_at }}
                    </q-td>
                    <q-td>
                        {{ props.row.user.name }}
                    </q-td>
                    <q-td>
                        <q-btn icon="edit" flat round dense size="sm" class="q-mr-sm"
                               :href="route('post.edit', props.row)"/>
                        <q-btn icon="delete" color="red" flat round dense size="sm"
                               :href="route('post.destroy', props.row)"/>
                    </q-td>
                </q-tr>
            </template>
            <template v-slot:bottom>
                <div class="col-12 q-pa-lg flex flex-center">
                    <app-pagination
                        v-model="$page.props.items.meta.current_page"
                        :max="$page.props.items.meta.last_page"
                        route="dashboard.posts.index"
                    />
                </div>
            </template>
        </q-table>

    </admin-wrp>
</template>

<script>
import AdminWrp from "../../Components/Admin/AdminWrp.vue";
import AppLink from "../../Components/App/AppLink.vue";
import AppPagination from "../../Components/App/AppPagination.vue";

export default {
    name: "PageAdminPosts",
    components: {AppPagination, AppLink, AdminWrp},
}
</script>

<style scoped>

</style>
