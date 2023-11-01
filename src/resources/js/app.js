import { createApp } from 'vue'
import router from './router'
import { createPinia } from 'pinia'
import App from './views/Main.vue'

import BootstrapVue from 'bootstrap-vue-3'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'

const app = createApp(App)

app.use(createPinia())
    .use(router)
    .use(BootstrapVue)
    .mount('#app')
