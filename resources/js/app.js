require('./bootstrap');

import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import App from './Layouts/App'
import NProgress from 'nprogress'
import { Inertia } from '@inertiajs/inertia'

Vue.use(InertiaApp)
const app = document.getElementById('app')

Vue.mixin({methods: {route: window.route}})

new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: (name) => {
              const page = require(`./Pages/${name}`).default
              page.layout = App
              return page
            }
        }
    }),
}).$mount(app)

// loading top line indicator (each page)
NProgress.configure({ showSpinner: false });
Inertia.on('start', () => NProgress.start())
Inertia.on('finish', () => NProgress.done())
