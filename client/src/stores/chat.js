import { defineStore } from "pinia";
import { ref } from "vue";

export const useChatStore = defineStore('chat', () => {
  
  const chats = ref([]);

  const activeChatId = ref();

  const form = ref({
    chat_id: null,
    content: null,
    type: 1,
  });

  const updateCurrentChat = (newChat, type) => {
    chats.value = chats.value.filter((chat) => chat.id !== newChat.id);

    chats.value.unshift(newChat);
  }

  return { 
    chats,
    activeChatId,
    form,
    updateCurrentChat
  }
});