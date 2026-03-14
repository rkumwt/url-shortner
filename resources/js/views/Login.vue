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
                        v-model:value="formData.email"
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
                        v-model:value="formData.password"
                        placeholder="Please Enter Your Password"
                    />
                </a-form-item>

                <a-form-item>
                    <a-button @click="onSubmit" :loading="loading" type="primary" block>
                        Submit
                    </a-button>
                </a-form-item>
            </a-form>
        </a-col>
    </a-row>
</template>
<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useRouter } from "vue-router";
import apiAdmin from "@/composable/apiAdmin";

const authStore = useAuthStore();
const router = useRouter();
const { loading, rules, apiRequest } = apiAdmin();
const formData = ref({
    email: "",
    password: "",
});

const onSubmit = () => {
    rules.value = {};
    loading.value = true;

    apiRequest({
        url: "login",
        data: formData.value,
        success: (res) => {
            authStore.updateAuthToken(res.data.token);
            router.push({ name: "superadmin.dashboard" });
        },
    });
};
</script>
