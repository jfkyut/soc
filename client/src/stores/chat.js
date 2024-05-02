import { defineStore } from "pinia";
import { ref } from "vue";

export const useChatStore = defineStore('chat', () => {
  
  const chats = ref([]);

  const activeChatId = ref();

  const addNewMessage = (message) => {
    chats.value
      .filter((chat) => chat.id === activeChatId.value)
      .map((chat) => {
        chat.messages[0] = message
      })
  }

  const updateExistingChat = (newChat) => {
    chats.value = chats.value
                    .filter((chat) => chat.id === newChat.id)
                    .unshift(newChat);
  }

  return { 
    chats,
    activeChatId,
    addNewMessage,
    updateExistingChat
  }
});