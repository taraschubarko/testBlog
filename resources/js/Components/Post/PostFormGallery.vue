<template>
<div class="row q-col-gutter-md q-mb-md">
    <div class="col-4" v-for="(item,k) in modelValue">
        <q-img :src="`/images/medium/${item.path}`">
            <div class="absolute-bottom text-subtitle1 text-center">
                <q-btn icon="delete" color="white" flat round dense/>
            </div>
        </q-img>
    </div>
</div>
</template>

<script>
export default {
    name: "PostFormGallery",

    props: {
        modelValue: {
            type: Array,
            default: () => []
        },
    },
}
</script>

<style scoped>

</style>
