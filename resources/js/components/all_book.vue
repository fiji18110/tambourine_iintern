<template>
    <div>
        <dl>
            <dt>Title</dt>
            <dd>{{JSON.parse(books)[2]['title']}}</dd>
            <dt>SubTitle</dt>
            <dd>{{JSON.parse(books)[2]['subTitle']}}</dd>
            <li v-for= "n in 3">
                {{JSON.parse(books)[n]['title']}}
            </li>
        </dl>
    </div>
</template>

<script>
    export default {
        props:{
            books:{
                type:String
            },
        },
        mounted() {
            console.log()
        }
    }
</script>