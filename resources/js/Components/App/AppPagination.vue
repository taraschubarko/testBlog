<template>
    <q-pagination
        v-model="modelValue"
        :max="max"
        :max-pages="6"
        boundary-numbers
        @update:model-value="gotoPage"
    />
</template>

<script>
export default {
    name: "AppPagination",
    props: {
        modelValue: {
            type: Number,
            default: 0
        },
        max: {
            type: Number,
            default: 0
        },
        route: {
            type: String,
            default: null
        },
    },
    methods: {
        gotoPage(page) {
            this.$inertia.get(route(this.route, {page: page}))
        }
    },
}
</script>

<style scoped>

</style>
