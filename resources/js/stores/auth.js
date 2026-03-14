import { ref, computed } from "vue";
import { defineStore } from "pinia";
import { AUTH_USER, AUTH_TOKEN } from "@/utils/localStorageKeys";
import { router } from "@/router";

const getValueFromLocalStorage = (key) => {
    return window.localStorage.getItem(key) || null;
}

export const useAuthStore = defineStore('auth', () => {
    const user = ref(null);
    const authToken = ref(getValueFromLocalStorage(AUTH_TOKEN));

    const isLoggedIn = computed(() => {
        return authToken.value === null || authToken.value === "" ? false : true;
    });

    const updateUser = (newVal) => {
        user.value = newVal;
    }

    const updateAuthToken = (newVal) => {
        authToken.value = newVal;
        window.localStorage.setItem(AUTH_TOKEN, newVal);
    }

    const updateUserAction = async () => {
        if (authToken.value) {
            const axiosAdmin = window.axiosAdmin;

            const response = await axiosAdmin.post('/user')
            console.log(response.data.user);
            updateUser(response.data.user)
        }
    }

    const logoutAction = () => {
        if (authToken.value) {
            const axiosAdmin = window.axiosAdmin;

            axiosAdmin.post('/logout').then(function (response) {
                window.localStorage.clear();

                updateAuthToken(null);
                updateUser(null);

                router.push({ name: "login" });
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
        logoutAction
    }
})
