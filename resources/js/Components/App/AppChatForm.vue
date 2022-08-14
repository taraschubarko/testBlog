<template>
<q-form class="AppChatForm" @submit="onSubmit">
    <div class="row">
        <div class="col-11">
            <input v-model="form.message" type="text" class="full-width" @keyup.enter="onSubmit">
        </div>
        <div class="col-1 text-right">
            <q-btn icon="send" :loading="loading" flat round dense type="submit"/>
        </div>
    </div>
</q-form>
</template>

<script>
export default {
    name: "AppChatForm",

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
            loading: false
        }
    },

    methods: {
        onSubmit() {
            if(this.form.message){
                this.loading = true;
                this.form.user_id = this.item.id;
                this.$inertia.post(route('message.store'), this.form, {
                    onSuccess: () => {
                        this.loading = false;
                        this.$q.notify({
                            type: 'positive',
                            message: 'Message sending!'
                        });
                        //Чистимо форму чату
                        this.form.message = null;
                    },
                    onError: (err) => {
                        this.loading = false;
                        this.$notyErr(err);
                    }
                });
            }
        }
    },
}
</script>

<style lang="scss" scoped>
.AppChatForm{
    background-color: $grey-3;
    padding: 10px;
    input{
        border: none;
        background: transparent;
        &:focus{
            outline: none;
        }
    }
}
</style>
