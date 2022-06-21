<template>
    <div class="profile-container">
        <div class="user-info">
            <h2>{{user.name}}</h2>
            <p>{{user.email}}</p>
        </div>
        <div>
            <h3>Peso actual</h3>
            <h5>{{currentWeight}}kg</h5>
            <a class="link weight-link" @click="add">{{translations['addWeight']}}</a>
            <canvas id="weightChart" width="900" height="200"></canvas>
        </div>
        <hr>
        <div>
            <h3>Objetivo de calorias</h3>
            <h5>{{translations['dailyCal']}}: {{calories}} kcal</h5>
            <a class="link weight-link" @click="updateCalories">{{translations['updateGoal']}}</a>
        </div>
        <h3>Mis recetas</h3>
        <div v-for="recipe in recipes">
            <div class="profile-recipe-container">
                <h4 class="link" @click="redirect(`../recipes/${recipe.id}/`)">{{recipe.name}}</h4>
                <p>{{recipe.description | truncate(200, '...')}}</p>
            </div>
        </div>
        <add-weight v-show="showModal" :currentWeight="currentWeight" :initialDate="date" @eventname="close" :userid="user.id" :translations="translations"></add-weight>
        <update-calories v-show="showModal2" :currentCalories="calories" @eventname="close" :userid="user.id" :translations="translations"></update-calories>
    </div>
</template>

<script>
    export default{
        props:[
            'user',
            'translations'
        ],
        data: function(){
            return{
                date: new Date().toISOString().slice(0, 10),
                weight: [],
                currentWeight: 0,
                showModal: false,
                showModal2: false,
                myChart: undefined,
                calories: 0,
                recipes: []
            }
        },
        mounted(){
            this.load();            
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

        methods:{
            load: function(){

                axios.get('api/profile/getWeight', {
                    params:{
                        user: this.user.id,
                    }
                }).then((response)=>{
                    this.weight = response.data;
                    this.currentWeight = this.weight[0].weight;

                    this.drawChart();
                }).catch(e=>{
                    console.log(e.response)
                }); 

                axios.get('api/profile/getCalories', {
                    params:{
                        user: this.user.id,
                    }
                }).then((response)=>{
                    this.calories = response.data;
                }).catch(e=>{
                    console.log(e.response)
                });         
                
                 axios.get('api/recipe/getUserRecipes', {
                    params:{
                        user: this.user.id,
                    }
                }).then((response)=>{
                    this.recipes = response.data;
                }).catch(e=>{
                    console.log(e.response)
                });        

                this.$forceUpdate();
            },

            drawChart(){
                const ctx = document.getElementById('weightChart').getContext('2d');    

                if(this.myChart != undefined) this.myChart.destroy();

                const labels = this.weight.map(a => a.date).reverse();
                const data = {
                labels: labels,
                datasets: [{
                    label: this.translations['weight'],
                    data: this.weight.map(a => a.weight).reverse(),
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
                };

                this.myChart = new Chart(ctx, {
                        type: 'line',
                        data: data,
                });
            },

            add(){
                this.showModal = true;
            },

            updateCalories(){
                this.showModal2 = true;
            },

            close: function(){
                this.showModal = false;
                this.showModal2 = false;
                this.load();
            },

            redirect(route){
                window.location.href = route;
            }
        }
    }
</script>
<style>
    .profile-container{
        width: 80%;
        margin: 0 auto;
        min-height: 600px;
        background-color: #f1f1f1;
        border: 1px solid grey;
    }

    .user-info{
        width: 100%;
        height: 100px;
        background-color: #a6a2a2;
        display: flex;
        justify-content: center;
        flex-direction: column;    
    }   

    .weight-link{
        display: block;
    }

    .profile-container h3:not(:first-child) {
        margin-top: 3%;
    }

    .profile-recipe-container{
        padding: 20px;
    }
</style>