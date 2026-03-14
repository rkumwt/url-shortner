<template>
    <a-button
        type="link"
        @click="
            () => {
                $router.push({ name: 'admin.dashboard' });
            }
        "
    >
        Dahboard
    </a-button>
    <a-button
        v-if="authStore.user?.type === 'admin'"
        type="link"
        @click="
            () => {
                $router.push({ name: 'admin.team_members' });
            }
        "
    >
        Team Members
    </a-button>
</template>

<script setup>
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();
</script>
