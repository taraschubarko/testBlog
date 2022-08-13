<template>
    <admin-wrp title="Edit user" page-class="q-pa-md">
        <template v-slot:name> - Edit user "{{$page.props.item.data.name}}"</template>
        <div class="row">
            <div class="col-6 offset-3">
                <admin-user-form v-model="$page.props.item.data" method="put"/>
            </div>
        </div>
    </admin-wrp>
</template>

<script>
import AdminWrp from "../../Components/Admin/AdminWrp.vue";
import AdminUserForm from "../../Components/Admin/User/AdminUserForm.vue";

export default {
    name: "PageAdminUserEdit",
    components: {AdminUserForm, AdminWrp}
}
</script>

<style scoped>

</style>
