// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import'./assets/css/style.css'
import axios from 'axios';

Vue.prototype.$http = axios;
//Vue.prototype.$url = "https://api.cirandababy.com/"
Vue.prototype.$url = "localhost:8000/"

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
