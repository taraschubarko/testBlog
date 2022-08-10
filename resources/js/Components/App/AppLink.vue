<template>
    <Link :href="href">{{ label }}<slot/></Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    name: "AppLink",
    components:{Link},
    props: {
        href: {
            type: [String,Object,Function],
            default: ''
        },
        label:{
            type: String,
            default: null,
        }
    },
}
</script>

<style scoped>

</style>
