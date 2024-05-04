<script setup>
import { useHttpMessage } from '@/http/message';
import { useChatStore } from '@/stores/chat';
import { storeToRefs } from 'pinia';
import { onMounted, ref, watch } from 'vue';
import PhotoVideo from './chatform-partials/PhotoVideo.vue';

const { activeChatId, form } = storeToRefs(useChatStore());

const { sendTextMessageRequest, sendBlobMessageRequest } = useHttpMessage();

const { updateCurrentChat } = useChatStore();

const messageTextAreaRef = ref(null);

const handleKeyDown = (e) => {
  (window.innerWidth >= 1024 && !e.shiftKey && e.key === 'Enter') && (
    e.preventDefault(),
    sendMessage()
  )
};

const sendMessage = async () => {

  form.value.chat_id = activeChatId.value

  if (form.value.type === 1) {
    const { data } = await sendTextMessageRequest(form.value);

    updateCurrentChat(data);
  } else {
    const { data } = await sendBlobMessageRequest(form.value);

    updateCurrentChat(data);

    form.value.type = 1;
  }

  form.value.content = null

  messageTextAreaRef.value.style.height = '42px';
}

watch(form.value, (form) => {
  messageTextAreaRef.value.style.height = messageTextAreaRef.value.scrollHeight + 'px';

  if (form.content === '' || form.content === null) {
    messageTextAreaRef.value.style.height = '42px';
  }
})

watch(activeChatId, () => {
  setTimeout(() => {
    messageTextAreaRef.value.focus()
  }, 200)
})

onMounted(() => {
  setTimeout(() => {
    messageTextAreaRef.value.focus()
  }, 200)
})

</script>

<template>
  
  <form @submit.prevent="sendMessage" class="flex justify-center">
    <label for="chat" class="sr-only">Your message</label>
    <div class="flex items-center px-3 py-1 rounded-lg bg-white border shadow-sm dark:bg-gray-700 dark:border-gray-600 max-w-4xl w-full">
      <PhotoVideo />
      <textarea 
        v-model="form.content" 
        id="chat" 
        rows="1" 
        @keydown="handleKeyDown"
        ref="messageTextAreaRef"
        class="block mx-4 p-2.5 w-full resize-none text-sm outline-none text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
        placeholder="Your message...">
      </textarea>
      <div class="h-full flex items-end py-1">
        <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
          <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
            <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
          </svg>
          <span class="sr-only">Send message</span>
        </button>
      </div>
    </div>
  </form>

</template>