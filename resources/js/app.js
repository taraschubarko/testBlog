import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import {usePage} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { Quasar, Notify } from 'quasar';
import '@quasar/extras/material-icons/material-icons.css'
import '@quasar/extras/fontawesome-v5/fontawesome-v5.css'
import 'quasar/src/css/index.sass'
import '../scss/app.scss'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Quasar, {
                plugins:{Notify}
            })
            .mixin({
                computed:{
                    $user: () => usePage().props.value.auth.user.data,
                },
                methods:{
                    $notyErr:(err) => {
                        let li = [];
                        Object.keys(err).map(v => {
                            li.push(`<li>${err[v]}</li>`)
                        })
                        Notify.create({
                            type: 'negative',
                            html: true,
                            message: `<ul>${li}</ul>`
                        });
                    },
                    $hasRole(role){
                        return this.$user.roles.includes(role);
                    }
                }
            })
            .mount(el)
    },
})

InertiaProgress.init({ color: '#21BA45' });
