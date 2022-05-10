<template>
    <div>
        <VueDatePicker v-model="date" format="DD-MM-YYYY" />
        <div v-for="meal in meals">
            <meals :mealName="meal[0]" :foods="meal" :date="date" :userid="userid" @update="loadFoods"></meals>
        </div>
    </div>
</template>

<script>
    import meal from './Meal.vue';
    import { VueDatePicker } from '@mathieustan/vue-datepicker';
    import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css';

    export default{
        props:[
            'userid',
        ],

        data: function(){
            return{
                foods: [],
                totalCalories: [],
                meal1: [name = "Breakfast"],
                meal2: [name = "Lunch"],
                meal3: [name = "Dinner"],
                meal4: [name = "Snacks"],
                meals: [],
                date: new Date().toISOString().slice(0, 10),
            }
        },
        watch: {
            date(newDate, oldDate) {
                this.loadFoods();
            }
        },

        components:{
            meal,
            VueDatePicker,
        },

        mounted(){
            this.loadFoods();

            /*axios.post('api/foods/addConsumedFood', {
                food: 1,
                user: String(this.userid),
                quantity: 415,
                meal: 4,
                date: new Date().toISOString().slice(0, 10),
            });*/
        },

        methods:{
            loadFoods: function(){
                this.meals = [this.meal1, this.meal2, this.meal3, this.meal4]

                this.meal1.splice(1);
                this.meal2.splice(1);
                this.meal3.splice(1);   
                this.meal4.splice(1);

                //request to the API
                axios.get('api/foods/consumedFoods', {
                    params: {
                        user: String(this.userid),
                        date: this.date
                    }
                }).then((response)=>{
                    for(var i = 0; i < response.data.length; i++){
                        this.meals[response.data[i].pivot.meal-1].push(response.data[i])
                    }

                }).catch();
            }
        }
    }
</script>
<style>
    .vd-picker__controls{
        height: unset !important;
    }
</style>