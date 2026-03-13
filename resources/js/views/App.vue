<template>
    <div>
        <h1>Hello Vue 3 + Laravel 12 🚀</h1>
        <p>{{ message }}</p>
        <router-view />
        <a-button type="primary">Button</a-button>
    </div>
</template>

<script setup>
import { ref } from "vue";

const message = ref("Vue is working with Laravel");
</script>
