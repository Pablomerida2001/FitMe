
<template>
  <div class="modal-overlay">
    <div class="modal">
        <a class="close" @click="close">X</a>
        <h6>Add new food</h6>
        <label class="foodLabel" for="query">Food</label>
        <input v-model="query" class="input" id="query" type="text" placeholder="Search..." @focus="search = true"/>
        <span v-for="food in foods" v-if="search" @click="selectFood(food)">
            <h5 class="foodName">{{food.name}}</h5>
            <p class="foodDescription">Calories: {{food.calories}} - Carbohydrates: {{food.carbohydrates}} - Fats: {{food.fats}} - Proteins: {{food.protein}}</p>
            <hr class="foodSeparator">
        </span>

        <label class="quantityLabel" for="quantity">Quantity(gr)</label>
        <input v-model="quantity" class="input" id="quantity" type="number"/>
        <label class="label" for="selectMeal">Meal</label>
        <select class="select" id="selectMeal" v-model="meal">
            <option>Breakfast</option>
            <option>Lunch</option>
            <option>Dinner</option>
            <option>Snacks</option>
        </select>
        <label class="label" for="datePicker">Date</label>
        <VueDatePicker v-model="date" format="DD-MM-YYYY" class="input" id="datePicker"/>
        <button @click="add" class="save-btn">Save</button>
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
            'initialDate',
            'mealName',
            'userid'
        ],

        watch: {
            initialDate(newDate, oldDate) {
                this.date = this.initialDate;
            },

            query: {
                handler: _.debounce(function () {
                    this.searchFoods(query)
                }, 100)

            }
        },

        data: function(){
            return{
                meal: this.mealName,
                meals: ["Breakfast", "Lunch", "Dinner", "Snacks"],
                quantity: 0,
                foods: [],
                selectedFood: [],
                date: this.initialDate,
                query: '',
                search: false,
            }
        },

        mounted(){
            this.loadFoods();
        },

        methods:{
            loadFoods: async function(){
            },

            add: function(){
                axios.post('api/foods/addConsumedFood', {
                    food: this.selectedFood.id,
                    user: String(this.userid),
                    quantity: this.quantity,
                    meal: this.meals.indexOf(this.meal) + 1,
                    date: this.date,
                });

                this.$emit('eventname');
            },

            searchFoods(query) {
                axios.get(`/api/foods/searchFoods`, {
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
                this.query = food.name;
                this.selectedFood = food;
                this.search = false;
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

    .quantityLabel{
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

    .foodSeparator{
        width: 80%;
        margin: 0 auto;
    }

    .foodName{
        margin-top: 15px;
    }

    .foodDescription{
        font-size: 13px;
        margin-top: 5px;
        margin-bottom: 10px;
    }
</style>