<template>
    <app-wrp title="Chat with user">

        <div class="chat-ms" v-if="$page.props.items">
            <div class="cont">
                <q-scroll-area ref="chatArea" @scroll="scrollinfo" style="height: 500px">
                    <q-chat-message
                        v-for="(item,k) in $page.props.items.data"
                        :name="item.user.name"
                        :sent="item.sent"
                        :stamp="item.created_at"
                    >
                        <template v-slot:avatar>
                            <q-avatar :color="item.sent ? 'primary' : 'green'" text-color="white"
                                      class="q-mr-md q-ml-md">
                                {{ item.user.first_letter }}
                            </q-avatar>
                        </template>
                        <template v-slot:default>
                            <div>
                                {{ item.data.message }}
                            </div>
                        </template>
                    </q-chat-message>
                </q-scroll-area>
            </div>
            <app-chat-form :item="$page.props.user"/>
        </div>
    </app-wrp>
</template>

<script>
import AppWrp from "../../Components/App/AppWrp.vue";
import AppChatForm from "../../Components/App/AppChatForm.vue";

export default {
    name: "PageUserChat",
    components: {AppChatForm, AppWrp},
    data() {
        return {
            scrollsize: 0
        }
    },
    watch: {
        scrollsize(newValue, oldValue) {
            this.$refs.chatArea.setScrollPosition('vertical', newValue-500,100);
        }
    },
    methods: {
        scrollinfo(info){
            const size = info.verticalSize;
            this.scrollsize = size;
        }
    },
}
</script>

<style lang="scss" scoped>
.chat-ms {
    border: 1px solid $grey-5;

    .cont {
        padding: 20px;
    }

    .AppChatForm {
        border-top: 1px solid $grey-5;
    }
}
</style>
