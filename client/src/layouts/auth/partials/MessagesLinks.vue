<script setup>

import { ref, watch } from 'vue';
import NavDropdownTrigger from '@/widgets/nav/NavDropdownTrigger.vue';
import NavDropdownLink from '@/widgets/nav/NavDropdownLink.vue';

defineProps({ chats: Object })

const emit = defineEmits(['onAccessLink'])

const isDropdownLinkShow = ref(JSON.parse(sessionStorage.getItem('messages-dropdown')) || false);

const toggleDropdown = () => {
  (!isDropdownLinkShow.value)
    ? isDropdownLinkShow.value = true
    : isDropdownLinkShow.value = false
}

watch(isDropdownLinkShow, (dropdownState) => {
  sessionStorage.setItem('messages-dropdown', JSON.stringify(dropdownState));
})

</script>

<template>
  <NavDropdownTrigger 
    button-text="Messages" 
    icon-class="fa fa-message" 
    @toggle-dropdown="toggleDropdown" 
    :is-links-show="isDropdownLinkShow"
    :route-contains="'/messages'">
    <NavDropdownLink 
      to="/messages/new" 
      @click="emit('onAccessLink')" 
      title="New Chat"
      class="bg-gray-800">
      <div class=" flex items-center justify-between">
        <span>New chat</span>
        <i class="fa fa-pen"></i>
      </div>
    </NavDropdownLink>
    <NavDropdownLink 
      v-for="(chat, index) in chats" 
      :key="index"
      :to="`/chat/${chat.id}`" 
      @click="emit('onAccessLink')"
      :chat="chat"
      :title="chat.title">
      <div class="truncate">
        {{ chat.title }}
      </div>
    </NavDropdownLink>
  </NavDropdownTrigger>
</template>