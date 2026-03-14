const routes = [{
    path: "/",
    component: () => import("@/views/layouts/Admin.vue"),
    children: [
        {
            path: "/admin/dashboard",
            name: "admin.dashboard",
            component: () => import("@/views/admin/Dashboard.vue"),
            meta: {
                requireAuth: true,
                allowedUserType: ['admin', 'member']
            }
        }
    ]
}];

export default routes;
