<template>
    <q-form @submit="onSubmit">
        <q-input v-model="form.name" label="Title" dense square filled
                 @blur="$vv.form.name.$touch"
                 :error="$vv.form.name.$error"
                 class="q-mb-sm"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.name.$errors">{{ item.$message }}</div>
            </template>
        </q-input>
        <q-input v-model="form.text" label="Body" dense square filled
                 @blur="$vv.form.text.$touch"
                 :error="$vv.form.text.$error"
                 class="q-mb-sm"
                 type="textarea"
                 rows="10"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.text.$errors">{{ item.$message }}</div>
            </template>
        </q-input>
        <post-form-gallery v-if="$page.props.gallery !== undefined" v-model="$page.props.gallery"/>
        <q-file v-model="form.image_files" label="Images" dense square filled
                @blur="$vv.form.image_files.$touch"
                :error="$vv.form.image_files.$error"
                class="q-mb-sm"
                use-chips
                multiple
                accept="image/*"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.image_files.$errors">{{ item.$message }}</div>
            </template>
        </q-file>
        <q-select v-model="form.type" label="Post type" dense square filled
                  @blur="$vv.form.type.$touch"
                  :error="$vv.form.type.$error"
                  class="q-mb-sm"
                  :options="optionsType"
                  emit-value
                  map-options
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.type.$errors">{{ item.$message }}</div>
            </template>
        </q-select>
        <q-select v-model="form.status" label="Post status" dense square filled
                  @blur="$vv.form.status.$touch"
                  :error="$vv.form.status.$error"
                  class="q-mb-sm"
                  :options="optionsStatus"
                  emit-value
                  map-options
                  v-if="method === 'put'"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.status.$errors">{{ item.$message }}</div>
            </template>
        </q-select>

        <q-input v-model="form.note.text" label="Explain the reason" dense square filled
                 @blur="$vv.form.note.text.$touch"
                 :error="$vv.form.note.text.$error"
                 class="q-mb-sm"
                 type="textarea"
                 rows="5"
                 v-if="form.status === 'canceled'"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.note.text.$errors">{{ item.$message }}</div>
            </template>
        </q-input>

        <div class="text-right">
            <q-btn label="Save" icon="save" :loading="loading" color="dark" type="submit" class="q-mb-md"/>
        </div>
    </q-form>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {email, minLength, required, requiredIf, sameAs} from "@vuelidate/validators";
import PostFormGallery from "../../Post/PostFormGallery.vue";

export default {
    name: "AminPostForm",
    components: {PostFormGallery},
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
                text: null,
                image_files: [],
                type: null,
                status: null,
                note: {
                    text: null
                },
            },
            loading: false,
        }
    },

    validations() {
        return {
            form: {
                name: {required},
                text: {required},
                image_files: {requiredIf: requiredIf(this.method === 'post')},
                type: {required},
                status: {requiredIf: requiredIf(this.method === 'put')},
                note: {
                    text: {requiredIf: requiredIf(this.form.status === 'canceled')},
                },
            }
        }
    },

    computed: {
        $vv() {
            return this.v$;
        },
        optionsType() {
            let o = [];
            for (const [key, value] of Object.entries(this.$page.props.config.type)) {
                o.push({
                    label: value,
                    value: key
                })
            }
            return o;
        },
        optionsStatus() {
            let o = [];
            for (const [key, value] of Object.entries(this.$page.props.config.status)) {
                o.push({
                    label: value,
                    value: key
                })
            }
            return o;
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
        post() {
            this.loading = true;
            this.$inertia.post(route('dashboard.posts.store'), this.form, {
                onSuccess: () => {
                    this.loading = false;
                },
                onError: (err) => {
                    this.loading = false;
                    this.$notyErr(err);
                }
            });
        },
        put() {
            this.loading = true;
            this.form._method = 'put';
            this.$inertia.post(route('dashboard.posts.update', this.modelValue), this.form, {
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
