<script setup>

import { useHttpUser } from '@/http/users';
import { useSidebarStore } from '@/stores/sidebar';
import { useUserStore } from '@/stores/users';
import { storeToRefs } from 'pinia';
import { onMounted } from 'vue';
import UserCard from '@/components/cards/UserCard.vue';

const { users } = storeToRefs(useUserStore());
const { isShow } = storeToRefs(useSidebarStore());

const { getUsers } = useHttpUser();

onMounted( async () => {
  const { data } = await getUsers();

  users.value = data;
})

</script>

<template>
  <div>

    <div 
      class="grid grid-cols-1 gap-4"
      :class="[isShow ? 'md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-4' : 'md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6']">
      

      <UserCard 
        v-for="(user, index) in users" :key="index" 
        :user="user" 
      />

    </div>
    

  </div>
</template>