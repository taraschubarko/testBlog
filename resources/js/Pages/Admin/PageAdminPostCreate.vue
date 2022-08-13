<template>
    <admin-wrp title="Create post" page-class="q-pa-md">
        <template v-slot:name> - Create post</template>
        <div class="row">
            <div class="col-6 offset-3">
                <amin-post-form/>
            </div>
        </div>
    </admin-wrp>
</template>

<script>
import AdminWrp from "../../Components/Admin/AdminWrp.vue";
import AminPostForm from "../../Components/Admin/Post/AminPostForm.vue";
export default {
    name: "PageAdminPostCreate",
    components: {AminPostForm, AdminWrp}
}
</script>

<style scoped>

</style>
