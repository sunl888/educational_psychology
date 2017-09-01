import axios from 'axios';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

let thttp = {};

thttp.config = {};

thttp.install = (Vue, {baseURL, router}) => {
  thttp.config = {
    baseURL
  };
  thttp.config['X-CSRF-TOKEN'] = token.content;
  Vue.prototype.$http = axios.create({
    baseURL,
    timeout: 5000,
    responseType: 'json',
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  });
  Vue.prototype.$http.interceptors.response.use((response) => {
    return response;
  }, (error) => {
    if (error.code === 'ECONNABORTED') {
      Vue.prototype.$Message.error('请求超时');
    } else if (error.response.status === 401) {
      Vue.prototype.$Message.error('请先登录');
      router.replace({name: 'login', query: {redirect: router.app.$route.name}});
    } else if (error.response.status === 422) {
      let errorsTemp = error.response.data.errors;
      for (let index in errorsTemp) {
        errorsTemp[index] = errorsTemp[index].join(',');
      }
    } else {
      if (error.config.noErrorTip) {
        return Promise.reject(error);
      }
      if (error.response.data.message) {
        Vue.prototype.$Notice.error({
          title: '出错了',
          desc: error.response.data.message
        });
      }
    }
    return Promise.reject(error);
  });
};

export default thttp;
