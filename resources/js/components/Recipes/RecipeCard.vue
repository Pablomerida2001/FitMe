<template>
    <div class="recipe-container">
        <div class="recipe-card-info">
            <div class="first-row">
                <h4 class="link" @click="showRecipe">{{recipe.name}}</h4>
                <button v-if="userid == recipe.owner || (recipe.owner == null && userid == -1)" class="edit-recipe-btn edit-card" @click="edit"><i class="bi bi-pencil"></i></button>
                <button class="delete-recipe-btn" v-if="userid == recipe.owner || (recipe.owner == null && userid == -1)" @click="deleteRecipe"><i class="bi bi-trash"></i></button>
            </div>
            <p>{{recipe.description | truncate(220, '...')}}</p>
            <a>{{translations["totalCal"]}}: {{calories.toFixed(0)}}Kcal | {{translations["protein"]}}: {{protein.toFixed(2)}}gr | {{translations["carbs"]}}: {{carbs.toFixed(2)}}gr | {{translations["fat"]}}: {{fats.toFixed(2)}}gr </a>
        </div>
        
        <recipe v-show="showRecipeInfo" @close="close" @update="update" :userid="userid" :translations="translations" :recipe="recipe" :calories="calories" :protein="protein" :carbs="carbs" :fats="fats" :foods="foods"></recipe>
        <edit-recipe v-show="showModal" @eventname="closeModal" :userid="userid" :translations="translations" :recipeName="recipe.name" :recipeDescription="recipe.description" :recipeIngredients="ingredients" :id="recipe.id"></edit-recipe>
    </div>
</template>

<script>

    export default{
        props:[
            'userid',
            'translations',
            'recipe',
            'id'
        ],

        data: function(){
            return{
                foods:[],
                calories: 0,
                protein: 0,
                carbs: 0,
                fats: 0,
                showRecipeInfo: false,
                ingredients: [],
                showModal: false,
                synth: null,
            }
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
            this.synth = new Tone.Synth();
	        this.synth.toMaster();
        },

        methods:{
            load: function(){
                axios.get('../../api/recipe/getRecipeFoods', {
                    params: {
                        recipe: this.recipe.id,
                    }
                }).then((response)=>{
                    this.foods = response.data;
                    this.calculate();
                }).catch(e=>{
                    console.log(e.response)
                });;

                this.ingredients = [];

                this.foods.forEach(food =>{
                    this.ingredients.push({"food": food, "quantity": food.pivot.quantity });
                });

                if(this.id == this.recipe.id) this.showRecipe();
            },

            calculate(){
                this.calories = 0;
                this.protein = 0;
                this.carbs = 0;
                this.fats = 0;

                this.foods.forEach(food => {
                    this.calories += food.calories * (food.pivot.quantity / 100);
                    this.protein += food.protein * (food.pivot.quantity / 100);
                    this.carbs += food.carbohydrates * (food.pivot.quantity / 100);
                    this.fats += food.fats * (food.pivot.quantity / 100);
                });
            },

            showRecipe(){
                var items = document.getElementsByClassName("recipe-card-info");
                for(var i = 0; i < items.length; i++){
                    items[i].style.display = "none";
                }
                this.showRecipeInfo = true;
            },

            close(){
                var items = document.getElementsByClassName("recipe-card-info");
                for(var i = 0; i < items.length; i++){
                    items[i].style.display = "block";
                }
                this.showRecipeInfo = false;
            },

            deleteRecipe(){
                axios.delete('../../api/recipe/deleteRecipe', {params: {
                    recipe: this.recipe.id,
                }}).catch(e=>{
                    console.log(e.response)
                }).then(()=>{
                    this.$emit('update');  
                });

                this.synth.triggerAttackRelease("C4", "8n");
                const noise = new Tone.Noise("pink").start();
                // make an autofilter to shape the noise
                const autoFilter = new Tone.AutoFilter({
                    frequency: "8n",
                    baseFrequency: 200,
                    octaves: 8
                });
                // connect the noise
                noise.connect(autoFilter);
                // start the autofilter LFO
                autoFilter.start();
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

            update(){
                this.$emit('update');
                this.load();
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

    .delete-recipe-btn{
        position: relative;
        top: 10px;
        height: 50%;
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
        display: inline-block;
        font-weight: 400;
        line-height: 1.6;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        border-radius: 0.25rem;
    }

    .first-row{
        display: inline-flex;
        justify-content: space-between;
        flex-wrap: wrap;
        width: 100%;
    }

    .edit-card{
        top: 10px;
    }
</style>