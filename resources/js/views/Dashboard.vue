<template>
    <a-row>
        <a-col :span="6" :offset="9"> Dashboard </a-col>
    </a-row>
</template>
<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();
const email = ref("");
const password = ref("");
const rules = ref({});

const onSubmit = () => {
    rules.value = {};

    axiosBase
        .post("http://sembark-url-shortner.test/api/login", {
            email: email.value,
            password: password.value,
        })
        .then((success) => {
            authStore.updateAuthToken(success.data.token);
        })
        .catch((error) => {
            rules.value = error.data.errors;
        });
};
</script>
