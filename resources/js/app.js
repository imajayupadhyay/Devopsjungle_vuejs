import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import ScrollProgress from './Pages/Common/ScrollProgress.vue';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({
            render: () => [
                h(ScrollProgress),
                h(App, props)
            ]
        });
        app.use(plugin);
        app.use(ZiggyVue);
        app.mount(el);
    },
});
