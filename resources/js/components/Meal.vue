
<template>
    <div>
        <table>
            <th id="firstColumn">{{mealName}}</th>
            <th id="secondColumn">{{calories}}&nbspKcal</th>
            <template v-for="(food, index) in foods" v-if="index > 0">
                <tr>
                    <td>{{food.name}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{food.pivot.quantity}}gr</td>
                    <td>{{food.calories * (food.pivot.quantity / 100)}}&nbspKcal</td>
                </tr>
            </template>
            <tr>
                <td class="link" @click="add">Add food</td>
                <add-food v-show="showModal" :mealName="mealName" :initialDate="date"></add-food>
            </tr>
            
        </table>
    </div>
</template>

<script>
    import addFood from './AddFood.vue';

    export default{
        props:[
            'mealName',
            'foods',
            'date'
        ],

        data: function(){
            return{
                calories: 0,
                showModal: false,
            }
        },

        watch: {
            // whenever question changes, this function will run
            foods(newFoods, oldFoods) {
                this.loadFoods();
            }
        },

        mounted(){
            this.loadFoods();
        },

        methods:{
            loadFoods: async function(){
                await new Promise(r => setTimeout(r, 300));

                this.calories = 0;
                
                for(var i = 1; i < this.foods.length; i++){
                    this.calories += this.foods[i].calories * (this.foods[i].pivot.quantity / 100);
                }
            },

            add: function(){
                this.showModal = true;
            }
        }
    }
</script>

<style>
    table{
        width: 90%;
        margin-top:5%
    }

    #firstColumn{
        width: 80%;
        background-color: grey;
        color: white;
        font-weight: bold
    }

    #secondColumn{
        width: auto;
        background-color: grey;
        color: white;
        font-weight: bold
    }

    tr:nth-of-type(even) {
      background-color:#ccc;
    }

    .link{
        color: blue;
        font-weight: normal;
        margin-top: 20px;
    }
</style>