<template>
    <q-form @submit="onSubmit">
        <q-input v-model="form.message" label="Message text" dense outlined
                 @blur="$vv.form.message.$touch"
                 :error="$vv.form.message.$error"
                 class="q-mb-sm"
                 type="textarea"
        >
            <template v-slot:error>
                <div v-for="(item,k) in $vv.form.message.$errors">{{item.$message}}</div>
            </template>
        </q-input>
        <div class="flex flex-center">
            <q-btn label="Send" :loading="loading" icon="send" color="primary" type="submit" class="q-mb-md"/>
        </div>
    </q-form>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required} from '@vuelidate/validators'
export default {
    name: "PostMessageForm",
    setup () {
        return { v$: useVuelidate() }
    },

    props: {
        item: {
            type: Object,
            default: () =>{}
        },
    },

    data() {
        return {
            form: {
                message: null,
            },
            loading: false,
        }
    },

    validations:{
        form: {
            message: { required },
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
