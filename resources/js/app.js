import './plugins';
import '../css/app.css'
import { createApp } from 'vue'
import App from '@/views/App.vue'
import { router } from '@/router'
import { createPinia } from "pinia";
import { useAuthStore } from '@/stores/auth';

const bootstarp = async () => {
    const app = createApp(App);
    const pinia = createPinia();

    app.use(pinia);

    // Load user data before setting up router
    const authStore = useAuthStore();
    await authStore.updateUserAction();

    app.use(router);
    app.mount('#app')
}

bootstarp();
