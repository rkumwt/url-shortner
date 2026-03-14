const routes = [{
    path: "/",
    component: () => import("@/views/layouts/Superadmin.vue"),
    children: [
        {
            path: "/superadmin/dashboard",
            name: "superadmin.dashboard",
            component: () => import("@/views/superadmin/Dashboard.vue"),
            meta: {
                requireAuth: true,
                allowedUserType: ['superadmin']
            }
        },
        {
            path: "/superadmin/urls",
            name: "superadmin.urls",
            component: () => import("@/views/superadmin/urls/index.vue"),
            meta: {
                requireAuth: true,
                allowedUserType: ['superadmin']
            }
        }
    ]
}];

export default routes;
