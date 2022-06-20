<template>
  <div class="modal-overlay">
    <div class="modal">
        <a class="close" @click="close">X</a>
        <h6>{{translations["add new"]}}</h6>

        <label class="label" style="left: -37%"for="name">{{translations["name"]}}</label>
        <input v-model="name" class="input" id="name" type="text"/>

        <label class="label" style="left: -37%"for="sets">{{translations["description"]}}</label>
        <textarea v-model="description" class="input" id="sets" type="text" rows="4"/>

        <label class="label" style="left: -35%" for="query">{{translations["ingredients"]}}</label>
        <input v-model="query" class="input" id="query" type="text" placeholder="Search..." @focus="search = true"/>
        <span v-for="food in foods" v-if="search" @click="selectFood(food)" style="cursor: pointer">
            <h5 class="exerciseName">{{food.name}}</h5>
            <hr class="Separator">
        </span>

        <div class="ingredient-list" v-for="(ingredient, index) in ingredients">
            <div class="ingredient-info">
                <a></a>
                <h5 @click="editFood(index, ingredient)" style="cursor: pointer">{{ingredient.food.name}} - {{ingredient.quantity}}gr.</h5>
                <button @click="removeIngredient(ingredient, index)" class="delete-recipe-btn" style="top: -7px;"><i class="bi bi-trash"></i></button>
            </div>
            <p>{{translations["calories"]}}: {{(ingredient.food.calories * (ingredient.quantity / 100)).toFixed(0)}} - {{translations["carbs"]}}: {{(ingredient.food.carbohydrates * (ingredient.quantity / 100)).toFixed(0)}} - {{translations["fat"]}}: {{(ingredient.food.fats * (ingredient.quantity / 100)).toFixed(0)}} - {{translations["protein"]}}: {{(ingredient.food.protein * (ingredient.quantity / 100)).toFixed(0)}}</p>
            <hr class="foodSeparator">
        </div>

        <button @click="save" class="save-btn">{{translations["save"]}}</button>
    </div>
    </div>
  </div>
</template>

<script>
    export default{
        props:[
            'userid',
            'translations',
            'recipeIngredients',
            'recipeName', 
            'recipeDescription',
            'id'
        ],

        watch: {
            query: {
                handler: _.debounce(function () {
                    this.searchExercise(query)
                }, 100)
            },

            recipeIngredients() {
                this.ingredients = this.recipeIngredients;
                this.name = this.recipeName;
                this.description = this.recipeDescription;
            }
        },

        data: function(){
            return this.initialState();
        },

        methods:{
            initialState(){
                return{
                    foods: [],
                    query: '',
                    search: false,
                    ingredients: [],
                    name: '',
                    description: ''
                }
            },

            save: function(){                
                axios.post('../../api/recipe/editRecipe', {
                    recipe: this.id,
                    name: this.name,
                    description: this.description,
                    ingredients: this.ingredients
                }).then(() => {
                    this.$emit('eventname');
                }).catch(err => {
                    console.log(err.response)
                });;
            },

            searchExercise(query) {
                axios.get(`../..//api/foods/searchFoods`, {
                    params: {
                        query: this.query
                    }
                }).then(res => {
                        this.foods = res.data;
                    }).catch(err => {
                    console.log(err)
                });
            },

            selectFood(food){
                Swal.fire({
                    title: this.translations['input'],
                    input: 'number',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    cancelButtonText: this.translations['cancel'],
                    confirmButtonText: this.translations['save'],
                    showLoaderOnConfirm: true,
                    preConfirm: (num) => {
                        this.ingredients.push({"food": food, "quantity": num });
                        this.query = "";
                        this.search = false;
                    }
                });
            },

            close: function(){
                this.$emit('eventname');
            },

            editFood(index, food){
                Swal.fire({
                    title: this.translations['input'],
                    input: 'number',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    cancelButtonText: this.translations['cancel'],
                    confirmButtonText: this.translations['save'],
                    showLoaderOnConfirm: true,
                    preConfirm: (num) => {
                        this.ingredients[index] = {"food": food.food, "quantity": num };
                        this.$forceUpdate();
                    }
                });
            },

            removeIngredient(ingredient, index){
                axios.delete('api/recipe/deleteRecipeFood', {
                    data:{
                        recipe: this.id,
                        food: ingredient.food.id,
                        quantity: ingredient.quantity
                    } 
                }).then(() =>{
                    this.ingredients.splice(index, 1);
                    this.$forceUpdate();
                }).catch(err => {
                    console.log(err.response)
                });;
            }
        }
    }
</script>

<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        background-color: #000000da;
        z-index: 999;
    }

    .modal {
        text-align: center;
        background-color: white;
        height: 650px;
        width: 550px;
        margin: auto;
        padding: 60px 0;
        border-radius: 20px;
        display: block;
        position: relative
    }
    .close {
        position: relative;
        top: -7%;
        right: -44%;
        color: black;
        cursor: pointer;
    }

    .close:hover {
        color: red;
    }

    h6 {
        font-weight: 500;
        font-size: 28px;
        margin: 20px 0;
    }

    p {
        font-size: 16px;
        margin: 20px 0;
    }

    .save-btn {
        background-color: green;
        width: 150px;
        height: 40px;
        color: white;
        font-size: 14px;
        border-radius: 16px;
        margin-top: 50px;
    }

    .setsLabel{
        margin-top: 5%;
        position: relative;
        left: -32%;
        margin-bottom: 5px;
    }

    .input{
        margin: 0 auto;
        display: block;
        width: 80%;
    }

    .select{
        margin: 0 auto;
        display: block;
        width: 80%;
        padding: 0.375rem 2.25rem 0.375rem 0.75rem;
        -moz-padding-start: calc(0.75rem - 3px);
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        background-color: #f8fafc;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .label{
        margin-top: 5%;
        position: relative;
        left: -36%;
        margin-bottom: 5px;
    }

    .Separator{
        width: 80%;
        margin: 0 auto;
    }

    .exerciseName{
        margin-top: 15px;
    }

    .Description{
        font-size: 13px;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .ingredient-list{
        margin-top: 20px;
    }

    .ingredient-info{
        display: flex;
        justify-content: space-around;
        align-content: center;
    }
</style>