<script setup>

import ChatForm from '@/widgets/chat/ChatForm.vue';
import ChatBubble from '@/widgets/chat/ChatBubble.vue';
import { useRoute } from 'vue-router';
import { computed, onMounted, ref, watch } from 'vue';
import { useHttpMessage } from '@/http/message';

const { getChatMessagesRequest } = useHttpMessage();

const route = useRoute();

const currentChatId = computed(() => route.params.id);

const chatChannel = Echo.private(`chat.${currentChatId.value}`);

const getMessages = async () => {
  const { data } = await getChatMessagesRequest(currentChatId.value);

  messages.value = data;
}

onMounted(() => {
  getMessages();

  console.log(chatChannel.listen('message-sent', (e) => {
    console.log(e);
  }));
})

watch(currentChatId, () => {
  getMessages();

  chatChannel.listen('message-sent', (e) => {
    console.log('test' + e);
  })
})

const messages = ref(null);

</script>

<template>
  <div class="relative min-h-[89vh]">

    <div class="h-[80vh] py-2 overflow-y-auto">
      <div class="p-1 max-w-7xl mx-auto" v-for="(message, index) in messages" :key="index">
        <ChatBubble :message="message" />
      </div>
    </div>
    
    <div class="w-full absolute bottom-4">
      <ChatForm :chat-id="currentChatId" />
    </div>
  </div>
</template>