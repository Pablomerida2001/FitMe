<template>
    <div>
        <h3>{{translations['tittle']}}</h3>

        <div v-for="recipe in recipes">
            <recipe-card :recipe="recipe" :translations="translations" :userid="userid"></recipe-card>
        </div>
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
                recipes: [],
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
                //request to the API
                axios.get('api/recipe/getAllRecipes', {
                    params: {
                        user: String(this.userid),
                    }
                }).then((response)=>{
                    this.recipes = response.data;
                }).catch();

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