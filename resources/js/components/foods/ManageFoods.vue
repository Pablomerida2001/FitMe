<template>
    <div>
        <span class="span-container">
            <table class="admin-table">
                <th>{{translations['name']}}</th>
                <th>{{translations['calories']}}</th>
                <th>{{translations['carbs']}}</th>
                <th>{{translations['fats']}}</th>
                <th>{{translations['protein']}}</th>
                <th>{{translations['options']}}</th>
                <template v-for="food in foods">
                    <tr>
                        <td>
                            {{food.name}}
                        </td>
                        <td>
                            {{food.calories}}
                        </td>
                        <td>
                            {{food.carbohydrates}}
                        </td>
                        <td>
                            {{food.fats}}
                        </td>
                        <td>
                            {{food.protein}}
                        </td>
                        <td>
                            <button class="admin-table-btn" @click="deleteFood(food)"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </template>
            </table>
        </span>
    </div>
</template>

<script>
    import meal from './Meal.vue';

    export default{
        props:[
            'userid',
            'translations'
        ],

        data: function(){
            return{
                foods: [],
            }
        },
        watch: {
            
        },

        mounted(){
            this.loadFoods();
        },

        methods:{
            loadFoods: function(){
                //request to the API
                axios.get('api/foods/getAllFoods', {}).then((response)=>{
                    this.foods = response.data;
                    console.log(this.foods);
                }).catch();
            },

            deleteFood: function(food){
                axios.delete('api/admin/foods/deleteFood', {data: {
                    food: food.id,
                }});

                this.loadFoods();
            },

            updateFood: function(food){

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

    .admin-table{
        margin: 3% auto auto auto;
    }

     th, td {
        border: 1px solid black;
    }

    .admin-table-btn{
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

</style>