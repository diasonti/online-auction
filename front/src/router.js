import Vue from 'vue'
import Router from 'vue-router'
import Index from "./views/Index"
import LotView from "./views/LotView"
import LogIn from "./views/LogIn"
import Registration from "./views/Registration"

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'index',
      component: Index
    },
    {
      path: '/login',
      name: 'login',
      component: LogIn,
    },
    {
      path: '/register',
      name: 'registration',
      component: Registration,
    },
    {
      path: '/lot/:lotId',
      name: 'lot',
      component: LotView,
      props: true
    },
  ],
  scrollBehavior (to, from, savedPosition) {
    return savedPosition || { x: 0, y: 0 }
  },
  linkActiveClass: 'is-active'
});

export default router;