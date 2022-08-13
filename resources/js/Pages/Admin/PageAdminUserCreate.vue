<template>
    <admin-wrp title="Create user" page-class="q-pa-md">
        <template v-slot:name> - Create user</template>
        <div class="row">
            <div class="col-6 offset-3">
                <admin-user-form/>
            </div>
        </div>
    </admin-wrp>
</template>

<script>
import AdminWrp from "../../Components/Admin/AdminWrp.vue";
import AdminUserForm from "../../Components/Admin/User/AdminUserForm.vue";

export default {
    name: "PageAdminUserCreate",
    components: {AdminUserForm, AdminWrp}
}
</script>

<style scoped>

</style>
