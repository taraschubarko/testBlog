<template>
    <app-wrp title="Edit Post">
        <q-banner inline-actions rounded class="bg-orange text-white q-mb-md" v-if="$page.props.note">
            {{$page.props.note.text}}
        </q-banner>
        <post-form v-model="$page.props.form.data" method="put"/>
    </app-wrp>
</template>

<script>
import AppWrp from "../../Components/App/AppWrp.vue";
import PostForm from "../../Components/Post/PostForm.vue";

export default {
    name: "PagePostEdit",
    components: {PostForm, AppWrp}
}
</script>

<style scoped>

</style>
