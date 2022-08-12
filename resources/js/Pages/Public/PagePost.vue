<template>
    <app-head :title="item.name"/>
    <main-layout>
        <q-page padding>
            <q-breadcrumbs active-color="primary" class="q-mb-lg">
                <q-breadcrumbs-el label="Posts" icon="home" :href="route('home')" />
                <q-breadcrumbs-el :label="item.name" />
            </q-breadcrumbs>

            <div class="row">
                <div class="col-6 offset-3">
                    <q-card class="my-card q-mb-lg" flat bordered>
                        <q-card-section>
                            <q-carousel
                                animated
                                v-model="slide"
                                arrows
                                navigation
                                infinite
                            >
                                <q-carousel-slide v-for="(val,k) in item.images"
                                                  :name="k"
                                                  :img-src="`/images/original/${val}`"
                                />
                            </q-carousel>

                            <h1 class="text-h4">{{ item.name }}</h1>
                            <div class="text">{{ item.text }}</div>
                            <div class="row q-mt-lg">
                                <div class="col-1">
                                    <q-avatar>
                                        <img src="https://cdn.quasar.dev/img/boy-avatar.png">
                                    </q-avatar>
                                </div>
                                <div class="col-11">
                                    <small class="text-grey-5">Author</small>
                                    <div class="q-mb-md">{{ item.user.name }}</div>
                                    <post-message v-if="$user && $user.id !== item.user.id" :item="item.user"/>
                                </div>
                            </div>
                        </q-card-section>

                        <q-separator/>

                        <q-card-actions>
                            <q-btn flat round icon="event"/>
                            <q-btn flat>{{ item.created_at }}</q-btn>
                            <q-btn flat color="primary">{{ item.type }}</q-btn>
                        </q-card-actions>
                    </q-card>
                </div>
            </div>
        </q-page>
    </main-layout>
</template>

<script>
import MainLayout from "../../Layouts/MainLayout.vue";
import AppHead from "../../Components/App/AppHead.vue";
import PostMessage from "../../Components/Post/PostMessage.vue";

export default {
    name: "PagePost",
    components: {PostMessage, AppHead, MainLayout},

    data() {
        return {
            slide: 0
        }
    },

    computed: {
        item() {
            return this.$page.props.item.data;
        }
    },
}
</script>

<style scoped>

</style>
