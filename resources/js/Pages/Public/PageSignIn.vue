<template>
    <app-head title="Sign In"/>
    <clear-layout>
        <q-page class="flex flex-center">
            <div style="min-width: 300px">
                <SignInForm/>
            </div>
        </q-page>
    </clear-layout>
</template>

<script>
import ClearLayout from "../../Layouts/ClearLayout.vue";
import AppHead from "../../Components/App/AppHead.vue";
import SignInForm from "../../Components/Auth/SignInForm.vue";
export default {
    name: "PageSignIn",
    components: {SignInForm, AppHead, ClearLayout}
}
</script>

<style scoped>

</style>
