
<template>
    <div>
        <table>
            <th id="firstColumn">{{mealName}}</th>
            <th id="secondColumn">{{calories.toFixed(0)}}&nbspKcal</th>
            <th id="thirdColumn"></th>
            <template v-for="(food, index) in foods" v-if="index > 0">
                <tr>
                    <td>{{food.name}}</td>
                    <td></td>
                    <td>
                        <button class="table-btn edit-btn" @click="edit(food)"><i class="bi bi-pencil"></i></button>
                        <button class="table-btn" @click="deleteFood(food)"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr class="row-border-bottom">
                    <td>{{food.pivot.quantity}}gr</td>
                    <td>{{(food.calories * (food.pivot.quantity / 100)).toFixed(0)}}&nbspKcal</td>
                </tr>
                <tr style="visibility: hidden"><td>.</td></tr>
            </template>
            <tr>
                <td class="link" @click="add">{{translations["add"]}}</td>
                <add-food v-show="showModal" :mealName="mealName" :initialDate="date" @eventname="close" :userid="userid" :translations="translations"></add-food>
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
            'date',
            'userid',
            'translations'
        ],

        data: function(){
            return{
                calories: 0,
                showModal: false,
                meals: [this.translations["breakfast"], this.translations["lunch"], this.translations["dinner"], this.translations["snacks"]],
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
            },

            close: function(){
                this.showModal = false;
                this.$emit('update');
            },
            
            deleteFood: function(food){
                axios.delete('api/foods/deleteConsumedFood', {data: {
                    food: food.id,
                    user: String(this.userid),
                    meal: String(this.meals.indexOf(this.mealName) + 1),
                    date: this.date,
                }});

                this.$emit('update');
            },

            edit(food){
                Swal.fire({
                    title: this.translations['input'],
                    input: 'number',
                    inputAttributes: {
                        value: food.pivot.quantity,
                        placeholder: food.pivot.quantity,
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    cancelButtonText: this.translations['cancel'],
                    confirmButtonText: this.translations['save'],
                    showLoaderOnConfirm: true,
                    preConfirm: (num) => {
                        if (num > 0){
                            food.pivot.quantity = num;

                            console.log(food);

                            axios.post('api/foods/editConsumedFood', {
                                food: food.id,
                                user: String(this.userid),
                                meal: food.pivot.meal,
                                date: this.date,
                                quantity: num,
                            }).then(()=>{
                                this.$emit('update');
                            }).catch(e=>{
                                console.log(e.response)
                            }); 
                        }
                    }
                });
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
        width: 75%;
        background-color: grey;
        color: white;
        font-weight: bold
    }

    #secondColumn{
        width: 15%;
        background-color: grey;
        color: white;
        font-weight: bold
    }

    #thirdColumn{
        width:10%;
        background-color: grey;
        color: white;
        font-weight: bold
    }

    .row-border-bottom {
        border-bottom: 1px solid black;
    }

    .link{
        color: blue;
        font-weight: normal;
        margin-top: 20px;
    }

    .table-btn{
        position: relative;
        top: 10px;
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

    .edit-btn{
        background-color: blue;
    }
</style>