<script setup>
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

onMounted(() => {
  router.push('/people');
})


</script>

<template>
  <div>
    home
  </div>
</template>