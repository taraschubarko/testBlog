<template>
    <admin-wrp title="Edit post" page-class="q-pa-md">
        <template v-slot:name> - Edit post "{{$page.props.item.data.name}}"</template>
        <div class="row">
            <div class="col-6 offset-3">
                <amin-post-form v-model="$page.props.item.data" method="put"/>
            </div>
        </div>
    </admin-wrp>
</template>

<script>
import AdminWrp from "../../Components/Admin/AdminWrp.vue";
import AminPostForm from "../../Components/Admin/Post/AminPostForm.vue";
export default {
    name: "PageAdminEditPost",
    components: {AminPostForm, AdminWrp}
}
</script>

<style scoped>

</style>
