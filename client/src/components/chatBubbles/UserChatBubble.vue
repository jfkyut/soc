<script setup>

defineProps({ message: Object })

const backendUrl = import.meta.env.VITE_BACKEND_URL;

</script>

<template>
  
  <div class="flex items-start justify-end gap-2.5">
    <div class="flex flex-col gap-1 max-w-[300px] sm:max-w-[400px] md:max-w-[650px] lg:max-w-3xl">
      <div class="flex items-center space-x-2 justify-end">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ message?.timestamp }}</span>
        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ message?.sender.name }}</span>
      </div>
      <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-blue-200 rounded-ss-xl rounded-ee-xl rounded-es-xl dark:bg-blue-700">
        <p v-if="message?.type_id === 1" class="text-sm font-normal text-gray-900 dark:text-white whitespace-pre">{{ message?.content }}</p>

        <video v-if="message?.type_id === 2" controls>
          <source :src="`${backendUrl}/storage/${message?.content}`">
          <!-- Additional source elements for different video formats or qualities -->
          Your browser does not support the video tag.
        </video>

        <img v-if="message?.type_id === 3" :src="`${backendUrl}/storage/${message?.content}`" alt="">
      </div>
      <span class="text-sm text-end font-normal text-gray-500 dark:text-gray-400">
        {{ message?.read_status !== 0 ? 'Seen' : 'Sent' }}
      </span>
    </div>
  </div>

</template>