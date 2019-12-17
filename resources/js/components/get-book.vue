<template>
  <div>
    <v-quagga :onDetected="logIt" :readerSize="readerSize" :readerTypes="['ean_reader']"></v-quagga>
  </div>
</template>

<script>
import Vue from 'vue'
import VueQuagga from 'vue-quaggajs';
// register component 'v-quagga'
Vue.use(VueQuagga);

export default {
  name: 'vue-barcode-test',
  data () {
    return {
      readerSize: {
        width: 100,
        height: 100,
      },
      detecteds: [],
      
    }
  },
  methods: {
    logIt (data) {
      while(data['codeResult']['code'].substr(0,3)=='978'){
        axios.get('/api/addBook',{
          params: {
            // ここにクエリパラメータを指定する
            isbn: data['codeResult']['code']
          }}).then((res) => {
            if(res=='OK'){
              document.location='/';
            }else if(res=='notExist'){
              alert('この本は登録できません');
              document.location='/';
            }else{
              document.location='/';
            }
          });
        console.log(data['codeResult']['code']);
        break;
      }
    },

  },
  
}
</script>
<style>
.drawingBuffer{
    margin-top: 10%;
    position: relative;
    width: 100vw;
    height: 40vh;
}
  
  video{
    margin-top: 10%;
    position: relative;
    width: 100vw;
    height: 40vh;
  }
</style>