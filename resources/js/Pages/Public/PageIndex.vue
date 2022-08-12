<template>
    <app-head title="Blog"/>
    <main-layout>
        <q-page padding>
            <div class="row">
                <div class="col-lg-6 offset-3">
                    <blog-item v-for="(item,k) in $page.props.items.data" :item="item" :key="k"/>
                </div>
            </div>
            <div class="flex flex-center q-mt-md">
                <app-paginate :last_page="$page.props.items.meta.last_page"/>
            </div>
        </q-page>
    </main-layout>
</template>

<script>
import MainLayout from "../../Layouts/MainLayout.vue";
import AppHead from "../../Components/App/AppHead.vue";
import BlogItem from "../../Components/Blog/BlogItem.vue";
import AppPaginate from "../../Components/App/AppPaginate.vue";
export default {
    name: "PageIndex",
    components:{AppPaginate, BlogItem, AppHead, MainLayout},
    // watch: {
    //     '$page.props.items.current_page': function (newValue, oldValue) {
    //         if(this.$page.props.items.last_page > 1){
    //             this.$inertia.get(route('home'), {page: newValue});
    //         }
    //     }
    // },
}
</script>

<style lang="scss" scoped>

</style>
