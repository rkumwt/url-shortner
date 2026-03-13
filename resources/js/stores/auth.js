import { ref, computed } from "vue";
import { defineStore } from "pinia";

const AUTH_USER = "auth_user";
const AUTH_TOKEN = "auth_token";

const getValueFromLocalStorage = (key) => {
    return window.localStorage.getItem(key) || null;
}

export const useAuthStore = defineStore('auth', () => {
    const user = ref(getValueFromLocalStorage(AUTH_USER));
    const authToken = ref(getValueFromLocalStorage(AUTH_TOKEN));

    const isLoggedIn = computed(() => {
        return authToken.value === null || authToken.value === "" ? false : true;
    });

    const updateUser = (newVal) => {
        user.value = newVal;
        window.localStorage.setItem(AUTH_USER, newVal);
    }

    const updateAuthToken = (newVal) => {
        authToken.value = newVal;
        window.localStorage.setItem(AUTH_TOKEN, newVal);
    }

    return {
        user,
        updateUser,
        isLoggedIn,

        authToken,
        updateAuthToken,
    }
})
