import { createApp } from 'vue';
import App from './Abc.vue';
import axios from 'axios';
import VueAxios from 'vue-axios';

const app = createApp(App);

// Configure Axios base URL if your API is hosted on a different domain
axios.defaults.baseURL = 'http://localhost:8080/api';

app.use(VueAxios, axios);
app.mount("#app");


