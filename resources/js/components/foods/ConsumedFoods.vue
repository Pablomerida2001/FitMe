<template>
    <div>
        <span class="span-container">
            <VueDatePicker v-model="date" format="DD-MM-YYYY" />
            <h4>{{translations["total"]}}: {{totalCalories}}/{{goal}}kcal</h4>
        </span>
        <div v-for="meal in meals">
            <meals :mealName="meal[0]" :foods="meal" :date="date" :userid="userid" :translations="translations" @update="loadFoods"></meals>
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
            'translations'
        ],

        data: function(){
            return{
                foods: [],
                totalCalories: 0,
                goal: 2000,//update this later
                meal1: [name = this.translations["breakfast"]],
                meal2: [name = this.translations["lunch"]],
                meal3: [name = this.translations["dinner"]],
                meal4: [name = this.translations["snacks"]],
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

            axios.get('api/profile/getCalories', {
                params:{
                    user: this.userid,
                }
            }).then((response)=>{
                this.goal = response.data;
            }).catch(e=>{
                console.log(e.response)
            }); 
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
                    this.totalCalories = 0;
                    for(var i = 0; i < response.data.length; i++){
                        this.meals[response.data[i].pivot.meal-1].push(response.data[i])
                        this.totalCalories += response.data[i].calories * (response.data[i].pivot.quantity / 100)
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

    .span-container{
        display: flex;
        width: 90%;
    }
</style>