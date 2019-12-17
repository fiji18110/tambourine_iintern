<template>
    
    <div>
        <dl>
            <div>
                <router-link to='/barcode_reader' class="btn-square-pop">バーコードリーダー</router-link>
                <router-view/>
            </div>
            <div>
            <div v-for="(book ,index) in books" :key="index">
                <div class="books">
                    <div>{{book.title}}<span @click="deleteItem(book.isbn)" class="command">[☓]</span></div>
                    <div>{{book.subTitle}}</div>
                    <div><img :src="book.imageUrl"/></div>
                </div>
                
            </div>
            </div>

        </dl>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() { //データの初期値を設定
            return{
                books:[]
            }
        },
        methods:{
            
            getBookInfo(){
                axios.get('/api/getInfo')
                .then(response =>  {
                    this.books=response.data;
                }).catch( error => { console.log(error); })
            },
            getImage(n){
                return this.imageUrl[n];
            },
            deleteItem(isbn){
                if(confirm('削除しますか？')){ //確認をとる
                console.log(isbn);
                    axios.get('/api/deleteBook',{
                     params: {
                        isbn: isbn
                        }}).then((res) => {
                        if(res[2]="OK"){
                            alert('削除に成功しました');
                            document.location='/';
                        }else{
                            alert('削除に失敗しました');
                            document.location='/';
                        }
                });
                }
            }
            
        },
        mounted() {
            console.log()
        },
        created() { 
            this.getBookInfo()
        }
    }
</script>
<style>
.books{
    text-align: center; 
    padding: 20px;
}
.btn-square-pop {
  position: relative;
  display: inline-block;
  padding: 0.25em 0.5em;
  text-decoration: none;
  color: #FFF;
  background: #fd9535;/*背景色*/
  border-bottom: solid 2px #d27d00;/*少し濃い目の色に*/
  border-radius: 4px;/*角の丸み*/
  box-shadow: inset 0 2px 0 rgba(255,255,255,0.2), 0 2px 2px rgba(0, 0, 0, 0.19);
  font-weight: bold;
}

.btn-square-pop:active {
  border-bottom: solid 2px #fd9535;
  box-shadow: 0 0 2px rgba(0, 0, 0, 0.30);
}
</style>