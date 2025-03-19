<script setup>
import { defineProps } from 'vue'

// Define props inside the setup script
const props = defineProps({
  id: [Number, String]
});
</script>

<template>
  <h1>{{ id }}</h1>  <!-- Directly access id without props. -->
</template>

<style>
</style>
