import Vue from 'vue'
import Router from 'vue-router'
import todolist from '@/components/todolist'

Vue.use(Router)

export default new Router({
  mode: 'hash',
  routes: [
    {
      path: '/',
      name: 'todolist',
      component: todolist
    }
  ]
})
