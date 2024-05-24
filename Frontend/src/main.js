import './assets/main.css'
import { createApp } from 'vue'
import VuePlyr from 'vue-plyr'
import 'vue-plyr/dist/vue-plyr.css'
import App from './App.vue'
import router from './router'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faBars, faTimes } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'


import axios from 'axios';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

library.add(faBars, faTimes)

const app = createApp(App)




app.use(router)
app.component('font-awesome-icon', FontAwesomeIcon)
app.mount('#app')