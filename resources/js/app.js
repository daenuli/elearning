import './bootstrap';
// import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Message from "@/Pages/Message.vue";
import Layout from "@/Pages/Layout.vue";
import {translations} from './Mixins/translations';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'E-learning management system';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .mixin(translations)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('Message', Message)
            .component('Layout', Layout)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#5DADE2' });
