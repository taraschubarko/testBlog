<template>
    <q-form @submit="onSubmit">
        <q-input v-model="form.name" label="Title" dense outlined
                 @blur="$vv.form.name.$touch"
                 :error="$vv.form.name.$error"
                 class="q-mb-sm"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.name.$errors">{{ item.$message }}</div>
            </template>
        </q-input>
        <q-input v-model="form.text" label="Body" dense outlined
                 @blur="$vv.form.text.$touch"
                 :error="$vv.form.text.$error"
                 type="textarea"
                 :rows="10"
                 class="q-mb-sm"
                 hint="min 100 words"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.text.$errors">{{ item.$message }}</div>
            </template>
        </q-input>
        <q-select v-model="form.type" label="Post type" dense outlined
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

        <post-form-gallery v-if="$page.props.gallery !== undefined" v-model="$page.props.gallery"/>

        <q-file v-model="form.image_files" label="Images" dense outlined
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

        <div class="text-right">
            <q-btn label="Save" icon="save" :loading="loading" color="primary" type="submit" class="q-mb-md"/>
        </div>
    </q-form>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import {required, email, minLength} from '@vuelidate/validators'
import PostFormGallery from "./PostFormGallery.vue";

export default {
    name: "PostForm",
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
                type: null,
                image_files: [],
            },
            loading: false,
        }
    },

    validations: {
        form: {
            name: {required},
            type: {required},
            image_files: {required},
            text: {required, minLength: minLength(100)},
        }
    },

    computed: {
        $vv() {
            return this.v$;
        },
        optionsType() {
            let o = [];
            for (const [key, value] of Object.entries(this.$page.props.type)) {
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
            switch (this.method){
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
            this.$inertia.post(route('post.store'), this.form, {
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
            this.$inertia.post(route('post.update'), this.form, this.modelValue, {
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
        if(this.modelValue){
            this.form = this.modelValue;
        }
    }
}
</script>

<style scoped>

</style>
