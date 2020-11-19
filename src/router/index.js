import Vue from 'vue'
import Router from 'vue-router'
import todolist from '@/components/todolist'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/todolist',
      name: 'todolist',
      component: todolist
    }
  ]
})
