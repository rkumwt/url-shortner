<template>
    <a-button type="link" @click="logout">Logout</a-button>
</template>

<script setup>
import { ExclamationCircleOutlined } from "@ant-design/icons-vue";
import { createVNode } from "vue";
import { useRouter } from "vue-router";
import { Modal } from "ant-design-vue";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const authStore = useAuthStore();

const logout = () => {
    Modal.confirm({
        title: "Logout?",
        icon: createVNode(ExclamationCircleOutlined),
        content: "Are you sure you want to logout?",
        onOk() {
            authStore.logoutAction();
        },
        onCancel() {},
    });
};
</script>
