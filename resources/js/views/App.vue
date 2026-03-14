<template>
    <div>
        <router-view />
    </div>
</template>

<script setup>
import { ref } from "vue";

const message = ref("Vue is working with Laravel");
</script>
