import './bootstrap';
import '../css/app.css';


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { PhosphorVue } from "phosphor-vue";

import VCalendar from 'v-calendar';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const VueApp = createApp({ render: () => h(app, props) });

        VueApp.config.globalProperties.$route = route;

        VueApp.use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PhosphorVue)
            .use(VCalendar, {})
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
