import { createApp } from 'vue'
import { Quasar, Notify, Loading, Dialog } from 'quasar'
import './css/style.css'
import App from './App.vue'
// Import icon libraries
import '@quasar/extras/material-icons/material-icons.css'

// Import Quasar css
import 'quasar/src/css/index.sass'


const app = createApp(App)

app.use(Quasar, {
  plugins: {
    Notify, 
    Dialog,
  },
  config: {
    notify: {}
  }
})
app.mount('#app')
