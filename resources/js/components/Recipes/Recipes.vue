<template>
    <div class="recipes-container">
        <h3>{{translations['tittle']}}</h3>
        <button class="btn btn-primary addBtn" @click="add">{{translations["add"]}}</button>        
        
        <div v-for="recipe in recipes">
            <recipe-card :recipe="recipe" :translations="translations" :userid="userid" @update="load" :id="id"></recipe-card>
        </div>
        <add-recipe v-show="showModal" @eventname="closeModal" :userid="userid" :translations="translations"></add-recipe>
    </div>
</template>

<script>

    export default{
        props:[
            'userid',
            'translations',
            'id'
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
            console.log(this.id)
        },

        methods:{
            load: function(){
                //request to the API
                axios.get('../../api/recipe/getAllRecipes', {
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

            closeModal: function(){
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