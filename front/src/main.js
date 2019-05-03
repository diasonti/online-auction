import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './api'

window.$ = require('jquery')
window.JQuery = require('jquery')

import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

Vue.config.productionTip = false

Vue.mixin({
  methods: {
    checkAuth() {
      if(this.$store.getters.token == null) {
        this.$router.replace("/");
        throw "front.auth.error";
      }
    }
  }
})

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
