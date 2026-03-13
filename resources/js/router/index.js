import { createWebHistory, createRouter } from 'vue-router'
import { useAuthStore } from "@/stores/auth";


const routes = [
    {
        path: '/',
        name: 'login',
        component: () => import('@/views/Login.vue'),
        meta: {
            requireUnauth: true,
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import('@/views/Dashboard.vue'),
        meta: {
            requireAuth: true,
        }
    },
]

export const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();

    if (to.meta && to.meta.requireAuth && !authStore.isLoggedIn) {
        next({ name: 'login' });
    } else if (to.name === 'login' && authStore.isLoggedIn) {
        next({ name: 'dashboard' });
    }

    console.log(to);

    next();
});

