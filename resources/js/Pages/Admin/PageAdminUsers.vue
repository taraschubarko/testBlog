<template>
    <admin-wrp title="Users">
        <template v-slot:name>- Users</template>
        <template v-slot:subh>
            <q-bar class="bg-primary">
                <q-btn :href="route('dashboard.users.create')" label="Create user" icon="add" flat class="text-white"/>
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
                    <q-th>User name</q-th>
                    <q-th>E-mail</q-th>
                    <q-th>Location</q-th>
                    <q-th>Birthday</q-th>
                    <q-th>Status</q-th>
                    <q-th>Created</q-th>
                    <q-th>Actions</q-th>
                </q-tr>
            </template>
            <template v-slot:body="props">
                <q-tr>
                    <q-td>{{ props.row.id }}</q-td>
                    <q-td>
                        {{props.row.name}}
                    </q-td>
                    <q-td>
                        {{props.row.email}}
                    </q-td>
                    <q-td>
                        {{ props.row.country }},  {{ props.row.city }}
                    </q-td>
                    <q-td>
                        {{ props.row.birthday }}
                    </q-td>
                    <q-td>
                        <q-badge :class="`badge-${props.row.status.label}`" rounded :label="props.row.status.label"/>
                    </q-td>
                    <q-td>
                        {{ props.row.created_at }}
                    </q-td>
                    <q-td>
                        <q-btn icon="edit" flat round dense size="sm" class="q-mr-sm"
                               :href="route('dashboard.users.edit', props.row)"/>
                        <admin-delete-button :route="route('dashboard.users.destroy', props.row)"/>
                    </q-td>
                </q-tr>
            </template>
            <template v-slot:bottom>
                <div class="col-12 q-pa-lg flex flex-center">
                    <app-pagination
                        v-model="$page.props.items.meta.current_page"
                        :max="$page.props.items.meta.last_page"
                        route="dashboard.users.index"
                    />
                </div>
            </template>
        </q-table>
    </admin-wrp>
</template>

<script>
import AdminWrp from "../../Components/Admin/AdminWrp.vue";
import AppPagination from "../../Components/App/AppPagination.vue";
import AdminDeleteButton from "../../Components/Admin/AdminDeleteButton.vue";

export default {
    name: "PageAdminUsers",
    components: {AdminDeleteButton, AppPagination, AdminWrp},
}
</script>

<style scoped>

</style>
