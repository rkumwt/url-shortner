import { ref } from "vue";

const apiAdmin = () => {
    const axiosAdmin = window.axiosAdmin;
    const rules = ref({});
    const loading = ref(false);

    const apiRequest = (configObject) => {
        const { url, data, success } = configObject;
        loading.value = true;
        rules.value = {};

        axiosAdmin
            .post(url, data)
            .then((res) => {
                loading.value = false;

                success(res);
            })
            .catch((error) => {
                rules.value = error.data && error.data.errors ? error.data.errors : {};
                loading.value = false;
            });
    }

    return {
        rules,
        loading,
        apiRequest
    }
}

export default apiAdmin;
