<script setup>

import DropdownMenu from '@/components/dropdowns/DropdownMenu.vue';
import DropdownButton from '@/components/dropdowns/DropdownButton.vue';
import { ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useChatStore } from '@/stores/chat';

const { form, activeChatId } = storeToRefs(useChatStore())

const showUploadOptions = ref(false);

const videoInputRef = ref(null);
const photoInputRef = ref(null);

const onSelectFile = (e, type) => {
  form.value.chat_id = activeChatId.value
  form.value.content = e.target.files[0];
  form.value.type = type;
}

</script>

<template>
  <div class="flex h-full items-end py-1 relative">
    <button 
      @mouseover="showUploadOptions = true" 
      @mouseout="showUploadOptions = false"
      type="button" 
      class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
        <path fill="currentColor" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
      </svg>
      <span class="sr-only">Upload image</span>
    </button>

    <DropdownMenu 
      :show="showUploadOptions"
      @mouseover="showUploadOptions = true" 
      @mouseout="showUploadOptions = false"
      position="bottom-14 -left-4">
      <DropdownButton @click="photoInputRef.click()">
        <i class="fa fa-image"></i>
        <span class="ms-3">Upload image</span>
      </DropdownButton>
      <DropdownButton @click="videoInputRef.click()">
        <i class="fa fa-video"></i>
        <span class="ms-3">Upload video</span>
      </DropdownButton>
    </DropdownMenu>

    <input type="file" class="sr-only" id="pic" accept="image/*" ref="photoInputRef" @change="(e) => onSelectFile(e, 3)">
    <input type="file" class="sr-only" id="vid" accept="video/mkv" ref="videoInputRef" @change="(e) => onSelectFile(e, 2)">
  </div>
</template>