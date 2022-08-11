<template>
    <q-form @submit="onSubmit">
        <h3 class="text-center">Sign Up</h3>
        <q-input v-model="form.name" label="Full name" dense outlined
                 @blur="$vv.form.name.$touch"
                 :error="$vv.form.name.$error"
                 class="q-mb-sm"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.name.$errors">{{ item.$message }}</div>
            </template>
        </q-input>
        <q-input v-model="form.email" label="E-mail" dense outlined
                 @blur="$vv.form.email.$touch"
                 :error="$vv.form.email.$error"
                 class="q-mb-sm"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.email.$errors">{{ item.$message }}</div>
            </template>
        </q-input>
        <q-input v-model="form.birthday" label="Birthday" dense outlined stack-label
                 @blur="$vv.form.birthday.$touch"
                 :error="$vv.form.birthday.$error"
                 class="q-mb-sm"
                 type="date"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.birthday.$errors">{{ item.$message }}</div>
            </template>
        </q-input>

        <div class="row q-mb-md" :class="{'text-negative': $vv.form.gender.$error}">
            <div class="col-6">
                <q-radio v-model="form.gender" :val="1" label="Male"
                         @blur="$vv.form.gender.$touch"
                         :error="$vv.form.gender.$error"
                />
            </div>
            <div class="col-6">
                <q-radio v-model="form.gender" :val="2" label="Female"
                         @blur="$vv.form.gender.$touch"
                         :error="$vv.form.gender.$error"
                />
            </div>
            <div class="col-12" v-if="$vv.form.gender.$errors.length">
                <small class="text-negative" v-for="(item,k) in $vv.form.gender.$errors">{{ item.$message }}</small>
            </div>
        </div>

        <q-input v-model="form.country" label="Country" dense outlined
                 @blur="$vv.form.country.$touch"
                 :error="$vv.form.country.$error"
                 class="q-mb-sm"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.country.$errors">{{ item.$message }}</div>
            </template>
        </q-input>

        <q-input v-model="form.city" label="City" dense outlined
                 @blur="$vv.form.city.$touch"
                 :error="$vv.form.city.$error"
                 class="q-mb-sm"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.city.$errors">{{ item.$message }}</div>
            </template>
        </q-input>

        <q-input v-model="form.password" label="Password" dense outlined
                 @blur="$vv.form.password.$touch"
                 :error="$vv.form.password.$error"
                 class="q-mb-sm"
                 type="password"
                 ref="password"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.password.$errors">{{item.$message}}</div>
            </template>
        </q-input>

        <q-input v-model="form.password_confirmation" label="Password confirmation" dense outlined
                 @blur="$vv.form.password_confirmation.$touch"
                 :error="$vv.form.password_confirmation.$error"
                 class="q-mb-sm"
                 type="password"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.password_confirmation.$errors">{{item.$message}}</div>
            </template>
        </q-input>


        <q-btn label="Register" :loading="loading" color="primary" type="submit" class="full-width q-mb-md"/>
        <div class="text-center">
            <app-link :href="route('login')" label="Sign In"/>
        </div>
    </q-form>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {email, minLength, required, sameAs} from "@vuelidate/validators";
import AppLink from "../App/AppLink.vue";

export default {
    name: "SignUpForm",
    components: {AppLink},
    setup () {
        return { v$: useVuelidate() }
    },

    data() {
        return {
            form: {
                name: null,
                email: null,
                birthday: null,
                gender: null,
                country: null,
                city: null,
                password: null,
                password_confirmation: null,
            },
            loading: false,
        }
    },

    validations:{
        form: {
            name: { required },
            email: { required, email },
            birthday: { required },
            gender: { required },
            country: { required },
            city: { required },
            password: { required, minLength: minLength(8) },
            password_confirmation: { required, minLength: minLength(8) },
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
            this.$inertia.post(route('register'), this.form, {
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
