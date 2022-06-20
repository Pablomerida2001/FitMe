
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

        <div class="ingredient-list" v-for="ingredient in ingredients">
            <h5>{{ingredient.food.name}} - {{ingredient.quantity}}gr.</h5>
            <p>{{translations["calories"]}}: {{(ingredient.food.calories * (ingredient.quantity / 100)).toFixed(0)}} - {{translations["carbs"]}}: {{(ingredient.food.carbohydrates * (ingredient.quantity / 100)).toFixed(0)}} - {{translations["fat"]}}: {{(ingredient.food.fats * (ingredient.quantity / 100)).toFixed(0)}} - {{translations["protein"]}}: {{(ingredient.food.protein * (ingredient.quantity / 100)).toFixed(0)}}</p>
            <hr class="foodSeparator">
        </div>

        <button @click="add" class="save-btn">{{translations["add"]}}</button>
    </div>
    </div>
  </div>
</template>

<script>
    import { VueDatePicker } from '@mathieustan/vue-datepicker';
    import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css';
    import {mapGetters} from 'vuex'

    export default{
        props:[
            'userid',
            'translations'
        ],

        watch: {
            query: {
                handler: _.debounce(function () {
                    this.searchExercise(query)
                }, 100)
            }
        },

        data: function(){
            return this.initialState();
        },

        methods:{
            initialState(){
                return{
                    foods: [],
                    ingredients: [],
                    name:'',
                    description:'',
                    query: '',
                    search: false,
                }
            },

            add: function(){
                var recipeId;

                axios.post('../../api/recipe/createRecipe', {
                    owner: String(this.userid),
                    name: this.name,
                    description: this.description,
                }).then((res) => {
                    recipeId = res.data;

                    this.ingredients.forEach(ingredient =>{
                        axios.post('../../api/recipe/addRecipeFood', {
                            recipe: recipeId,
                            food: ingredient.food.id,
                            quantity: ingredient.quantity,
                        });
                    });

                    Object.assign(this.$data, this.initialState());
                    this.$emit('eventname');
                }).catch(err => {
                    console.log(err)
                });;

            },

            searchExercise(query) {
                axios.get(`../../api/foods/searchFoods`, {
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
</style>