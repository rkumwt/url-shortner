import './plugins';
import '../css/app.css'
import { createApp } from 'vue'
import App from '@/views/App.vue'
import { router } from '@/router'
import { createPinia } from "pinia";
import { useAuthStore } from '@/stores/auth';

const app = createApp(App);
app.use(router);
app.use(createPinia())

const authStore = useAuthStore();
authStore.updateUserAction();

app.mount('#app')
