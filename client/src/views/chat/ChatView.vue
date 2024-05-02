<script setup>

import ChatForm from '@/widgets/chat/ChatForm.vue';
import ChatBubble from '@/widgets/chat/ChatBubble.vue';
import { useRoute } from 'vue-router';
import { computed, onMounted, ref, watch } from 'vue';
import { useHttpMessage } from '@/http/message';

const { getChatMessagesRequest } = useHttpMessage();

const route = useRoute();

const chatContainerRef = ref(null);

const currentChatId = computed(() => route.params.id);

const getMessages = async () => {
  const { data } = await getChatMessagesRequest(currentChatId.value);

  messages.value = data;
}

const setChatContainerHeight = () => {
  setTimeout(() => {
    if (chatContainerRef.value) {
      chatContainerRef.value.scrollTop = chatContainerRef.value.scrollHeight
    }
  }, 200)
}

onMounted( async () => {
  await getMessages()

  setChatContainerHeight();

  Echo.private(`chat.${currentChatId.value}`).listen('.message-sent', (e) => {
    messages.value.push(e.message)
  })
})

watch(currentChatId, async () => {
  await getMessages()

  setChatContainerHeight()

  Echo.private(`chat.${currentChatId.value}`).listen('.message-sent', (e) => {
    messages.value.push(e.message)
  })
})

const messages = ref(null);

watch(messages, () => {
  console.log('there is a change');
  setChatContainerHeight();
}, { deep: true })

</script>

<template>
  <div class="relative min-h-[89vh]">

    <div class="h-[80vh] py-2 overflow-y-auto scroll-smooth" ref="chatContainerRef">
      <div class="p-1 max-w-7xl mx-auto" v-for="(message, index) in messages" :key="index">
        <ChatBubble :message="message" />
      </div>
    </div>
    
    <div class="w-full absolute bottom-4">
      <ChatForm :chat-id="currentChatId" />
    </div>
  </div>
</template>