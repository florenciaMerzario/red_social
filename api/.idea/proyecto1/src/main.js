import Vue from 'vue'
import App from './App.vue'
import router from './router'

import '../../api/css/bootstrap.min.css';
import '../../api/css/estilos.css';

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app') . $
