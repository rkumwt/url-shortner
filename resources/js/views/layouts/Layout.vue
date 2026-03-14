<template>
    <a-layout class="layout">
        <a-layout-header :style="{ background: '#fff', padding: 50 }">
            <a-row>
                <a-col :span="12">
                    <a-row>
                        <a-col :span="6">
                            <span style="font-weight: bolder">
                                {{ authStore.user?.company?.name }}
                            </span>
                        </a-col>
                        <a-col :span="18">
                            <SuperadminMenus
                                v-if="authStore.user?.type === 'superadmin'"
                            />
                            <AdminMenus
                                v-if="['admin', 'member'].includes(authStore.user?.type)"
                            />
                        </a-col>
                    </a-row>
                </a-col>
                <a-col :span="12" :style="{ textAlign: 'right' }">
                    <Logout />
                </a-col>
            </a-row>
        </a-layout-header>
        <a-layout-content style="padding: 0 50px; height: 100vh;å">
            <router-view />
        </a-layout-content>
    </a-layout>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import Logout from "@/views/components/Logout.vue";
import AdminMenus from "./AdminMenus.vue";
import SuperadminMenus from "./SuperadminMenus.vue";

const authStore = useAuthStore();
</script>

<style scoped>
.site-layout-content {
    min-height: 280px;
    padding: 24px;
    background: #fff;
}
#components-layout-demo-top .logo {
    float: left;
    width: 120px;
    height: 31px;
    margin: 16px 24px 16px 0;
    background: rgba(255, 255, 255, 0.3);
}
.ant-row-rtl #components-layout-demo-top .logo {
    float: right;
    margin: 16px 0 16px 24px;
}

[data-theme="dark"] .site-layout-content {
    background: #141414;
}
</style>
