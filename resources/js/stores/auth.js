import { ref, computed } from "vue";
import { defineStore } from "pinia";
import { AUTH_USER, AUTH_TOKEN } from "@/utils/localStorageKeys";

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

    const updateUserAction = () => {
        if (authToken) {
            const axiosAdmin = window.axiosAdmin;

            axiosAdmin.post('/user').then(function (response) {
                // updateUser(response.data.user);
            }).catch(function (error) { });
        }
    }

    return {
        user,
        updateUser,
        isLoggedIn,

        authToken,
        updateAuthToken,

        updateUserAction,
    }
})
