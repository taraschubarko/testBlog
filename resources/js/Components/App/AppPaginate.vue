<template>
    <q-btn size="sm" round dense color="primary" v-if="last_page > 1" v-for="n in last_page" :key="n" :label="n"
        class="q-mr-sm" :href="`?page=${n}`"
    />
</template>

<script>
import AppLink from "./AppLink.vue";

export default {
    name: "AppPaginate",
    components: {AppLink},

    props: {
        last_page: {
            type: Number,
            default: 1
        },
    },
}
</script>

<style scoped>

</style>
