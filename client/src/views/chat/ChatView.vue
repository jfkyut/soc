<script setup>

import ChatForm from '@/widgets/chat/ChatForm.vue';
import ChatBubble from '@/widgets/chat/ChatBubble.vue';

const messages = [
  {
    content: "yo wassup",
    user_id: "9bd8ae12-24c2-4761-8138-7b65ca456d7b"
  },
  {
    content: "yo wassup",
    user_id: "9bd7a4fe7976a385"
  },
  {
    content: "yo wassup",
    user_id: "9bd8ae12-24c2-4761-8138-7b65ca456d7b"
  },
  {
    content: "yo wassup",
    user_id: "9bd7ab71--84fe7976a385"
  },
  {
    content: "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt corrupti, ipsum, iusto quae voluptate atque natus laboriosam temporibus sequi veniam, quis praesentium aspernatur exercitationem ipsam adipisci labore totam! Facere, maiores.",
    user_id: "9bd8ae12-24c2-4761-8138-7b65ca456d7b"
  },
  {
    content: "yo wassup",
    user_id: "9bd8ae12-24c2-4761-8138-7b65ca456d7b"
  },
  {
    content: "yo wassup",
    user_id: "9bd7ab71--84fe7976a385"
  },
  {
    content: "yo wassup",
    user_id: "9bd7ab71--84fe7976a385"
  },
  {
    content: "yo wassup",
    user_id: "9bd7ab71--84fe7976a385"
  },
  {
    content: "yo wassup",
    user_id: "9bd7ab71--84fe7976a385"
  },
  {
    content: "yo wassup",
    user_id: "9bd7ab71--84fe7976a385"
  },
]

</script>

<template>
  <div class="relative min-h-[89vh]">

    <div class="h-[80vh] py-2 overflow-y-auto">
      <div class="p-1 max-w-7xl mx-auto" v-for="(message, index) in messages" :key="index">
        <ChatBubble :message="message" />
      </div>
    </div>
    
    <div class="w-full absolute bottom-4">
      <ChatForm />
    </div>
  </div>
</template>