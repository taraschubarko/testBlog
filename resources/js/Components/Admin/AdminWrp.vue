<template>
    <app-head :title="title">
        <slot name="head"/>
    </app-head>
    <admin-layout>
        <template v-slot:name><slot name="name"/></template>
        <template v-slot:subh><slot name="subh"/></template>
        <slot name="top"/>
        <q-page :class="pageClass">
            <slot/>
        </q-page>
    </admin-layout>
</template>

<script>
import AppHead from "../App/AppHead.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
export default {
    name: "AdminWrp",
    components: {AdminLayout, AppHead},
    props: {
        title: {
            type: String,
            default: null
        },
        pageClass: {
            type: String,
            default: null
        },
    },
}
</script>

<style scoped>

</style>
