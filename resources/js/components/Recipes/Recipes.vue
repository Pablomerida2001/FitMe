<template>
    <div>
        <h3>{{translations['tittle']}}</h3>
    </div>
</template>

<script>

    export default{
        props:[
            'userid',
            'translations'
        ],

        data: function(){
            return{
                date: new Date().toISOString().slice(0, 10),
                exercises: [],
                showModal: false,
            }
        },
        watch: {
        },

        components:{
        },

        mounted(){
            this.load();
        },

        methods:{
            load: function(){
                
            },

            add: function(){
                this.showModal = true;
            },

            close: function(){
                this.showModal = false;
                this.load();
            },
        }
    }
</script>
<style>
    .vd-picker__controls{
        height: unset !important;
    }

    .span-container{
        display: flex;
        width: 90%;
    }

    .link:hover{
        color:blue;
        cursor: pointer
    }

    .empty{
        margin: 0 auto;
    }
</style>