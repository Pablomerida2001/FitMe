<template>
    <div class="recipe-container">
        <h4 class="link" @click="showRecipe">{{recipe.name}}</h4>
        <p>{{recipe.description | truncate(220, '...')}}</p>
        <a>{{translations["totalCal"]}}: {{calories.toFixed(0)}}Kcal | {{translations["protein"]}}: {{protein.toFixed(2)}}gr | {{translations["carbs"]}}: {{carbs.toFixed(2)}}gr | {{translations["fat"]}}: {{fats.toFixed(2)}}gr </a>
        <recipe v-show="showRecipeInfo" @close="close" :userid="userid" :translations="translations" :recipe="recipe" :calories="calories" :protein="protein" :carbs="carbs" :fats="fats" :foods="foods"></recipe>
    </div>
</template>

<script>

    export default{
        props:[
            'userid',
            'translations',
            'recipe'
        ],

        data: function(){
            return{
                foods:[],
                calories: 0,
                protein: 0,
                carbs: 0,
                fats: 0,
                showRecipeInfo: false,
            }
        },
        watch: {
        },

        filters:{
            truncate: function (text, length, suffix) {
                if (text.length > length) {
                    return text.substring(0, length) + suffix;
                } else {
                    return text;
                }
            },
        },

        mounted(){
            this.load();
        },

        methods:{
            load: function(){
                axios.get('api/recipe/getRecipeFoods', {
                    params: {
                        recipe: this.recipe.id,
                    }
                }).then((response)=>{
                    this.foods = response.data;
                    this.calculate();
                }).catch();
            },

            calculate(){
                this.foods.forEach(food => {
                    this.calories += food.calories * (food.pivot.quantity / 100);
                    this.protein += food.protein * (food.pivot.quantity / 100);
                    this.carbs += food.carbohydrates * (food.pivot.quantity / 100);
                    this.fats += food.fats * (food.pivot.quantity / 100);
                });
            },

            showRecipe(){
                this.showRecipeInfo = true;
            },

            close(){
                this.showRecipeInfo = false;
            }
        }
    }
</script>
<style>
   .recipe-container{
        width: 80%;
        margin: 0 auto;
        background-color: #f1f1f1;
        border: 1px solid grey;
        margin-bottom: 15px;
        padding: 20px
    }
</style>