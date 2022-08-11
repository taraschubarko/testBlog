<template>
    <q-form @submit="onSubmit">
        <h3 class="text-center">Sign In</h3>
        <q-input v-model="form.email" label="E-mail" dense outlined
                 @blur="$vv.form.email.$touch"
                 :error="$vv.form.email.$error"
                 class="q-mb-sm"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.email.$errors">{{item.$message}}</div>
            </template>
        </q-input>
        <q-input v-model="form.password" label="Password" dense outlined
                 @blur="$vv.form.password.$touch"
                 :error="$vv.form.password.$error"
                 class="q-mb-sm"
                 type="password"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.password.$errors">{{item.$message}}</div>
            </template>
        </q-input>
        <q-btn label="Login" :loading="loading" color="primary" type="submit" class="full-width q-mb-md"/>
        <div class="text-center">
            <app-link :href="route('register')" label="Sign Up"/>
        </div>
    </q-form>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required, email, minLength } from '@vuelidate/validators'
import AppLink from "../App/AppLink.vue";
export default {
    name: "SignInForm",
    components: {AppLink},
    setup () {
        return { v$: useVuelidate() }
    },

    data() {
        return {
            form: {
                email: null,
                password: null,
            },
            loading: false,
        }
    },

    validations:{
        form: {
            email: { required, email },
            password: { required, minLength: minLength(8) },
        }
    },

    computed: {
        $vv() {
            return this.v$;
        }
    },

    methods: {
        onSubmit() {
            this.$vv.form.$touch();
            if (this.$vv.form.$error) {
                return;
            }
            this.loading = true;
            this.$inertia.post(route('login'), this.form, {
                onSuccess: () => {
                    this.loading = false;
                },
                onError: (err) => {
                    this.loading = false;
                    this.$notyErr(err);
                }
            });
        }
    },


}
</script>

<style scoped>

</style>
