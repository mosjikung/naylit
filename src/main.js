import Vue from 'vue'
import App from './App.vue'
import router from './router/router'
import store from '../src/store'
import './quasar'
import vueNumeralFilterInstaller from 'vue-numeral-filter';
import VueGoogleCharts from 'vue-google-charts'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)
Vue.config.productionTip = false
Vue.use(vueNumeralFilterInstaller);
Vue.use(VueGoogleCharts)

// Vue.prototype.$api = 'http://127.0.0.1:9000/naylit/'
Vue.prototype.$api = 'http://webalert.nanyangtextile.com:85/naylit/'
Vue.prototype.$apiflask = 'http://qbi.nanyangtextile.com:9080/naylit/api/'
// Vue.prototype.$apiflask = 'http://127.0.0.1:9080/naylit/api/'
Vue.prototype.$appName = 'NAYLIT'
Vue.prototype.$syscode = 'NAYLIT'

Vue.prototype.$makeItFalsy = function(it) {
  this.it = !this.it;
};

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
