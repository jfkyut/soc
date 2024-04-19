<script setup>

import ChatForm from '@/widgets/chat/ChatForm.vue';
import ResponseChatBubble from '@/widgets/chat/ResponseChatBubble.vue';
import UserChatBubble from '@/widgets/chat/UserChatBubble.vue';

</script>

<template>
  <div class="relative min-h-[89vh]">

    <ResponseChatBubble />
    <UserChatBubble />
    <div class="w-full absolute bottom-4">
      <ChatForm />
    </div>
  </div>
</template>