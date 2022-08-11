<template>
    <app-head title="Sign Up"/>
    <clear-layout>
        <q-page padding class="flex flex-center">
            <div style="min-width: 300px">
                <sign-up-form/>
            </div>
        </q-page>
    </clear-layout>
</template>

<script>
import ClearLayout from "../../Layouts/ClearLayout.vue";
import AppHead from "../../Components/App/AppHead.vue";
import SignUpForm from "../../Components/Auth/SignUpForm.vue";

export default {
    name: "PageSignUp",
    components: {SignUpForm, AppHead, ClearLayout}
}
</script>

<style scoped>

</style>
