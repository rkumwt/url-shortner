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
            }
        }
    ]
}];

export default routes;
