<template>
    <app-head :title="title">
        <slot name="head"/>
    </app-head>
    <main-layout>
        <q-page padding>
            <div class="row">
                <div class="col-6 offset-3">
                    <slot/>
                </div>
            </div>
        </q-page>
    </main-layout>
</template>

<script>
import AppHead from "./AppHead.vue";
import MainLayout from "../../Layouts/MainLayout.vue";

export default {
    name: "AppWrp",
    components: {MainLayout, AppHead},
    props: {
        title: {
            type: String,
            default: null
        },
    },
}
</script>

<style scoped>

</style>
