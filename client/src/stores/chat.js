import { defineStore } from "pinia";
import { ref } from "vue";

export const useChatStore = defineStore('chat', () => {
  
  const chats = ref([]);

  const activeChatId = ref();

  const updateCurrentChat = (newChat) => {
    chats.value = chats.value.filter((chat) => chat.id !== newChat.id);

    chats.value.unshift(newChat);
  }

  return { 
    chats,
    activeChatId,
    updateCurrentChat
  }
});