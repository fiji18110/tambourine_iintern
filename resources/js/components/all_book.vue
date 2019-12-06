<template>
    <div>
        <dl>

            <dd></dd>
            <ol class="track">
            <li v-for="n of title.length">
                <a>Title :</a>{{title[n-1]}}
                <br>
                <a>SubTitle :</a>{{subTitle[n-1]}}
                <br>
                <!-- <a>URL :</a><img src={{imageUrl[n-1]}}/> -->
                <a>URL :</a><img src='/img/Gazou_187.jpg'/> 
                <!--laravelのコントローラで画像を保存、保存先のパスをimageUrlに格納、その際に同じisbnがないか調べる-->
                <!-- <a>URL :</a>{{imageUrl[n-1]}} -->
                <br>
                <a>ISBN :</a>{{isbn[n-1]}}
                <br>

            </li>
            </ol>

        </dl>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() { //データの初期値を設定
        return {
            title:[],
            subTitle:[],
            imageUrl:[],
            isbn:[],
            
        };
        },
        methods:{
            getBookInfo(){
                axios.get('http://localhost:8000/api/getInfo')
                .then(response =>  {
                    for(var i=0,l=response.data.length;i<l;i++){
                        this.title.push(response.data[i].title);
                        this.subTitle.push(response.data[i].subTitle);
                        this.imageUrl.push(response.data[i].imageUrl);
                        this.isbn.push(response.data[i].isbn);
                    }
                }).catch( error => { console.log(error); })
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