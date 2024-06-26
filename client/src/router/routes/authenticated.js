import AuthenticatedLayout from '@/layouts/auth/AuthenticatedLayout.vue';
import guards from '@/router/guards/guards';
const { authenticated, verified } = guards();

const authenticatedRoutes = [
  {
    path: '/',
    alias: ['/home', '/dashboard'],
    name: 'home',
    component: () => import('@/views/home/HomeView.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Home'
    },
    beforeEnter: [authenticated, verified]
  },
  {
    path: '/account',
    name: 'account',
    component: () => import('@/views/profile/ProfileView.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Account'
    },
    beforeEnter: [authenticated, verified]
  },
  {
    path: '/people',
    name: 'people',
    component: () => import('@/views/people/PeopleView.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'People'
    },
    beforeEnter: [authenticated, verified]
  },
  {
    path: '/chat',
    name: 'new chat',
    component: () => import('@/views/chat/ChatView.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'New chat'
    },
    beforeEnter: [authenticated, verified]
  },
  {
    path: '/chat/:id',
    name: 'chat',
    component: () => import('@/views/chat/ChatView.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Chat'
    },
    beforeEnter: [authenticated, verified]
  },
];

export default authenticatedRoutes;