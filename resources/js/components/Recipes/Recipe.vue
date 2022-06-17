<template>
    <div class="recipe">
        <div class="recipe-info">
            <div class="first-row">
                <p class="arrow-icon"><i class="bi bi-arrow-left-circle-fill" @click="close"></i></p>
                <h1 class="recipe-tittle" >{{recipe.name}}</h1>
                <button v-if="userid == recipe.owner || (recipe.owner == null && userid == -1)" class="edit-recipe-btn" @click="edit"><i class="bi bi-pencil"></i></button>
            </div>
            <h3>{{translations['description']}}</h3>
            <p>{{recipe.description}}</p>
            <h3>{{translations['ingredients']}}</h3>
            <div v-for="food in foods">
                <h5>- {{food.name}}, {{food.pivot.quantity}}grs.</h5>
            </div>
            <h3>{{translations['nutrition']}}</h3>
            <a>{{translations["totalCal"]}}: {{calories.toFixed(0)}}Kcal | {{translations["protein"]}}: {{protein.toFixed(2)}}gr | {{translations["carbs"]}}: {{carbs.toFixed(2)}}gr | {{translations["fat"]}}: {{fats.toFixed(2)}}gr </a>
        </div>
        <edit-recipe v-show="showModal" @eventname="closeModal" :userid="userid" :translations="translations" :recipeName="recipe.name" :recipeDescription="recipe.description" :recipeIngredients="ingredients" :id="recipe.id"></edit-recipe>
    </div> 
</template>

<script>
    export default{
        props:[
            'userid',
            'translations',
            'recipe',
            'foods',
            'calories',
            'protein',
            'carbs',
            'fats',
        ],

        data: function(){
            return{
                showModal: false,
                ingredients: []
            }
        },

        mounted(){
            this.load();
        },

        methods:{
            load: function(){    
                this.ingredients = [];

                this.foods.forEach(food =>{
                    this.ingredients.push({"food": food, "quantity": food.pivot.quantity });
                });
            },

            close(){
                this.$emit('close');
            },
            
            edit(){
                this.load();
                this.showModal = true;
            },

            closeModal: function(){
                this.showModal = false;
                this.$emit('update');
                this.load();
            },
        }
    }
</script>
<style>
    .recipe{
        position: absolute; 
        top: 8%; 
        left: 0%;
        z-index: 10;
        min-height: 100%;
        width: 100%;
        background-color: white;
    }

   .recipe-info{
        margin: 0 auto;
        width: 80%;
        height: 100%;
        background-color: #f1f1f1;
        border: 1px solid grey;
        margin-bottom: 15px;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .recipe-tittle{
        margin: 0 auto;
        font-style: bold;
        margin-bottom: 3%;
    }

    .recipe-info h3{
        margin-top: 3%;
    }

    .first-row{
        display: flex;
    }

    .edit-recipe-btn{
        position: relative;
        height: 50%;
        color: #fff;
        background-color: blue;
        border-color: #dc3545;
        display: inline-block;
        font-weight: 400;
        line-height: 1.6;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        border-radius: 0.25rem;
    }

    .arrow-icon{
        font-size: 1.5rem;
        cursor: pointer;
    }
</style>