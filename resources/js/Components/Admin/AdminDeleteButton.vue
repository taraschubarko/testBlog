<template>
<q-form @submit="onSubmit" class="AdminDeleteButton">
    <q-btn icon="delete" color="red" flat round dense size="sm" type="submit"/>
</q-form>
</template>

<script>
export default {
    name: "AdminDeleteButton",
    props: {
        route: {
            type: [String,Array,Object,Function],
            default: null
        },
    },
    methods: {
        onSubmit() {
            this.$inertia.delete(this.route,  {
                onSuccess: () => {
                   this.$q.notify({
                       type:'positive',
                       message: 'Deleted!'
                   });
                },
                onError: (err) => {
                    this.$notyErr(err);
                }
            });
        }
    },
}
</script>

<style lang="scss" scoped>
.AdminDeleteButton{
    display: inline-block;
}
</style>
