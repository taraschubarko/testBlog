<template>
    <q-form @submit="onSubmit">
        <q-input v-model="form.name" label="Full name" dense square filled
                 @blur="$vv.form.name.$touch"
                 :error="$vv.form.name.$error"
                 class="q-mb-sm"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.name.$errors">{{ item.$message }}</div>
            </template>
        </q-input>
        <q-input v-model="form.email" label="E-mail" dense square filled
                 @blur="$vv.form.email.$touch"
                 :error="$vv.form.email.$error"
                 class="q-mb-sm"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.email.$errors">{{ item.$message }}</div>
            </template>
        </q-input>
        <q-input v-model="form.birthday" label="Birthday" dense square filled stack-label
                 @blur="$vv.form.birthday.$touch"
                 :error="$vv.form.birthday.$error"
                 class="q-mb-sm"
                 type="date"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.birthday.$errors">{{ item.$message }}</div>
            </template>
        </q-input>
        <label>Gender</label>
        <div class="row q-mb-md" :class="{'text-negative': $vv.form.gender.$error}">
            <div class="col-2">
                <q-radio v-model="form.gender" :val="1" label="Male"
                         @blur="$vv.form.gender.$touch"
                         :error="$vv.form.gender.$error"
                />
            </div>
            <div class="col-2">
                <q-radio v-model="form.gender" :val="2" label="Female"
                         @blur="$vv.form.gender.$touch"
                         :error="$vv.form.gender.$error"
                />
            </div>
            <div class="col-12" v-if="$vv.form.gender.$errors.length">
                <small class="text-negative" v-for="(item,k) in $vv.form.gender.$errors">{{ item.$message }}</small>
            </div>
        </div>
        <admin-field-country v-model="form.country"
                             class="q-mb-sm"
                             @blur="$vv.form.country.$touch"
                             :error="$vv.form.country.$error"
                             :errors="$vv.form.country.$errors"
        />
        <admin-field-city v-model="form.city" v-model:country="form.country"
                          class="q-mb-sm"
                          @blur="$vv.form.city.$touch"
                          :error="$vv.form.city.$error"
                          :errors="$vv.form.city.$errors"
        />
        <q-input v-model="form.password" label="Password" dense square filled
                 @blur="$vv.form.password.$touch"
                 :error="$vv.form.password.$error"
                 class="q-mb-sm"
                 type="password"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.password.$errors">{{ item.$message }}</div>
            </template>
        </q-input>

        <admin-field-roles v-model="form.roles"
                           class="q-mb-sm"
                           @blur="$vv.form.roles.$touch"
                           :error="$vv.form.roles.$error"
                           :errors="$vv.form.roles.$errors" />

        <admin-field-status
            v-model="form.status"
            class="q-mb-sm"
            @blur="$vv.form.status.$touch"
            :error="$vv.form.status.$error"
            :errors="$vv.form.status.$errors"
        />

        <div class="text-right">
            <q-btn label="Save" icon="save" :loading="loading" color="dark" type="submit" class="q-mb-md"/>
        </div>
    </q-form>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {email, minLength, required, requiredIf, sameAs} from "@vuelidate/validators";
import AdminFieldCountry from "../Fields/AdminFieldCountry.vue";
import AdminFieldCity from "../Fields/AdminFieldCity.vue";
import AdminFieldRoles from "../Fields/AdminFieldRoles.vue";
import AdminFieldStatus from "../Fields/AdminFieldStatus.vue";

export default {
    name: "AdminUserForm",
    components: {AdminFieldStatus, AdminFieldRoles, AdminFieldCity, AdminFieldCountry},
    setup() {
        return {v$: useVuelidate()}
    },

    props: {
        modelValue: {
            type: Object,
            default: () => {
            }
        },
        method: {
            type: String,
            default: 'post'
        },
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
                roles: [],
                status: null,
            },
            loading: false,
        }
    },

    validations() {
        return {
            form: {
                name: {required},
                email: {required, email},
                birthday: {required},
                gender: {required},
                country: {required},
                city: {required},
                password: {requiredIf: requiredIf(this.method === 'post'), minLength: minLength(8)},
                roles: {required},
                status: {required},
            }
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
            switch (this.method) {
                case 'post':
                    this.post()
                    break;
                case 'put':
                    this.put()
                    break;
            }
        },
        post(){
            this.loading = true;
            this.$inertia.post(route('dashboard.users.store'), this.form, {
                onSuccess: () => {
                    this.loading = false;
                },
                onError: (err) => {
                    this.loading = false;
                    this.$notyErr(err);
                }
            });
        },
        put(){
            this.loading = true;
            this.form._method = 'put';
            this.$inertia.post(route('dashboard.users.update', this.modelValue), this.form, {
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

    created() {
        if (this.modelValue) {
            this.form = this.modelValue;
        }
    }
}
</script>

<style scoped>

</style>
