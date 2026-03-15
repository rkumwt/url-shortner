import { createWebHistory, createRouter } from 'vue-router'
import { useAuthStore } from "@/stores/auth";
import superadminRoute from "@/router/superadmin";
import adminRoute from "@/router/admin";

const routes = [
    {
        path: '/invite/:code',
        name: 'invite.register',
        component: () => import('@/views/InviteRegister.vue'),
        meta: {
            requireUnauth: true,
        }
    },
    {
        path: '/',
        name: 'login',
        component: () => import('@/views/Login.vue'),
        meta: {
            requireUnauth: true,
        }
    },
    ...adminRoute,
    ...superadminRoute,
]

export const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();

    if (to.meta && to.meta.requireAuth && !authStore.isLoggedIn) {
        return next({ name: 'login' });
    } else if (to.name === 'login' && authStore.isLoggedIn) {
        const redirectUrl =
            authStore.user?.type === "superadmin" ? "superadmin.dashboard" : "admin.dashboard";
        return next({ name: redirectUrl });
    } else if (to.meta?.allowedUserType && authStore.user) {
        const allowedTypes = to.meta.allowedUserType;

        if (!allowedTypes.includes(authStore.user.type)) {
            const redirectUrl =
                authStore.user.type === "superadmin" ? "superadmin.dashboard" : "admin.dashboard";
            return next({ name: redirectUrl });
        }
    }

    next();
});

