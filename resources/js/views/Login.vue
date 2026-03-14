<template>
    <a-row>
        <a-col :span="6" :offset="9">
            <a-form layout="vertical">
                <a-form-item
                    label="Email"
                    name="email"
                    :help="rules.email ? rules.email[0] : null"
                    :validateStatus="rules.email ? 'error' : null"
                    class="required"
                >
                    <a-input
                        v-model:value="email"
                        placeholder="Please Enter Your Email"
                    />
                </a-form-item>

                <a-form-item
                    label="Password"
                    name="password"
                    :help="rules.password ? rules.password[0] : null"
                    :validateStatus="rules.password ? 'error' : null"
                    class="required"
                >
                    <a-input-password
                        v-model:value="password"
                        placeholder="Please Enter Your Password"
                    />
                </a-form-item>

                <a-form-item>
                    <a-button @click="onSubmit" :loading="loading" type="primary" block
                        >Submit</a-button
                    >
                </a-form-item>
            </a-form>
        </a-col>
    </a-row>
</template>
<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useRouter } from "vue-router";

const authStore = useAuthStore();
const router = useRouter();
const email = ref("");
const password = ref("");
const rules = ref({});
const loading = ref(false);

const onSubmit = () => {
    rules.value = {};
    loading.value = true;

    axiosBase
        .post("http://sembark-url-shortner.test/api/login", {
            email: email.value,
            password: password.value,
        })
        .then((success) => {
            loading.value = false;
            authStore.updateAuthToken(success.data.token);
            router.push({ name: "dashboard" });
        })
        .catch((error) => {
            rules.value = error.data.errors;
            loading.value = false;
        });
};
</script>
