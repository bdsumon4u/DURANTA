require('./bootstrap');

import mitt from "mitt";
const emitter = mitt();

// Import modules...
import { ucfirst, ucwords, calculateTotal, moneyFormat, addToCart, updateCart, makeTitle } from "./functions";
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const el = document.getElementById('app');

const app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route, ucfirst, ucwords, calculateTotal, moneyFormat, addToCart, updateCart, makeTitle } })
    .use(InertiaPlugin);

app.config.globalProperties.emitter = emitter;
app.mount(el);

InertiaProgress.init({ color: '#4B5563' });
