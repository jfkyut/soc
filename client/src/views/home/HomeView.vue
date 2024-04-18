<script setup>
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

onMounted(() => {
  router.push('/messages/new');
})


</script>

<template>
  <div>
    home
  </div>
</template>