<template>
    <app-wrp title="Create Post">
        <h4>Create new post</h4>
        <post-form/>
    </app-wrp>
</template>

<script>
import AppWrp from "../../Components/App/AppWrp.vue";
import PostForm from "../../Components/Post/PostForm.vue";
export default {
    name: "PagePostCreate",
    components: {PostForm, AppWrp},
}
</script>

<style scoped>

</style>
