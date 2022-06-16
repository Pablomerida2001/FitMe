<template>
    <div>
        <div class="calories-container">
            <h3>{{translations['calories']}}</h3>
            <div class="calories-info">
                <h4>{{translations["todayCal"]}} {{totalCalories}}/{{caloriesGoal}}kcal</h4>
                <canvas id="caloriesChart" width="600" height="200"></canvas>
                <a class="link" @click="redirect(foodsroute)">{{translations["addFood"]}}</a>
            </div>
        </div>

        <div class="exercises-container">
            <h3>{{translations['workout']}}</h3>
            <a class="link" @click="redirect(workoutsroute)">{{translations["registerWorkout"]}}</a>
        </div>

        <div class="calories-container">
            <h3>{{translations['recipes']}}</h3>                
            <h5>{{translations["recipesText"]}}  <a class="link" @click="redirect(recipesroute)">{{translations["browseRecipes"]}}</a></h5>
        </div>
    </div>
</template>

<script>

    export default{
        props:[
            'userid',
            'translations',
            'foodsroute',
            'workoutsroute',
            'recipesroute',
        ],

        data: function(){
            return{
                recipes: [],
                foods: [],
                totalCalories: 0,
                caloriesGoal: 0,
            }
        },

        mounted(){
            this.load();
        },

        methods:{
            load: function(){
                axios.get('api/profile/getCalories', {
                params:{
                    user: this.userid,
                }
                }).then((response)=>{
                    this.caloriesGoal = response.data;
                }).catch(e=>{
                    console.log(e.response)
                });

                axios.get('api/foods/consumedFoods', {
                    params: {
                        user: String(this.userid),
                        date: new Date().toISOString().slice(0, 10)
                    }
                }).then((response)=>{
                    this.foods = response.data;

                    this.totalCalories = 0;

                    for(var i = 0; i < response.data.length; i++){
                        this.totalCalories += response.data[i].calories * (response.data[i].pivot.quantity / 100)
                    }

                    this.drawChart();
                }).catch();

            },

            drawChart(){
                const ctx = document.getElementById('caloriesChart').getContext('2d');    

                if(this.myChart != undefined) this.myChart.destroy();

                const labels = [this.translations["consumedCalories"], this.translations["remainingCalories"]];
                const data = {
                labels: labels,
                datasets: [{
                    label: this.translations['calories'],
                    data: [this.totalCalories, this.caloriesGoal - this.totalCalories],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        '#f1f1f1',
                    ],
                    tension: 0.1
                }]
                };

                this.myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: false
                    },
                    tooltip: {
                        valueSuffix: 'Kcal'
                    },
                });
            },

            redirect(route){
                window.location.href = route;
            }
        }
    }
</script>
<style>
    .calories-container{
        margin-top: 3%;
    }

    .calories-info{
        display: flex;
        margin-top: 2%;
        border: 0.5px solid black;
        align-items: center;
    }

    @media (max-width: 990px) {
        .calories-info{
            flex-direction: column;
        }
    }

    @media (max-width: 600px) {
        #caloriesChart{
            width: 450px !important;
            height: 150px !important;
        }
    }

    .exercises-container{
        margin-top: 3%;
    }
</style>