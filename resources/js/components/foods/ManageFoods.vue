<template>
    <div>
        <button class="btn btn-primary addBtn" @click="add">{{translations["add"]}}</button>        
        <span class="span-container">
            <table class="admin-table">
                <th class="border">{{translations['name']}}</th>
                <th class="border">{{translations['calories']}}</th>
                <th class="border">{{translations['carbs']}}</th>
                <th class="border">{{translations['fats']}}</th>
                <th class="border">{{translations['protein']}}</th>
                <th class="border">{{translations['options']}}</th>
                <template v-for="food in foods">
                    <tr>
                        <td class="border">
                            {{food.name}}
                        </td>
                        <td class="border">
                            {{food.calories}}
                        </td>
                        <td class="border">
                            {{food.carbohydrates}}
                        </td>
                        <td class="border">
                            {{food.fats}}
                        </td>
                        <td class="border">
                            {{food.protein}}
                        </td>
                        <td class="border">
                            <button class="btn btn-primary addBtn" @click="editFood(food)">{{translations["edit"]}}</button>                            
                            <button class="admin-table-btn" @click="deleteFood(food)"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </template>
            </table>
            <create-food v-show="showModal" @eventname="close" :userid="userid" :translations="translations" :edit="edit" :food="food"></create-food>
        </span>
    </div>
</template>

<script>
    export default{
        props:[
            'userid',
            'translations'
        ],

        data: function(){
            return{
                foods: [],
                food: {},
                edit: false,
                showModal: false,
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
                }).catch();
            },

            deleteFood: function(food){
                axios.delete('api/admin/foods/deleteFood', {data: {
                    food: food.id,
                }});

                this.loadFoods();
            },

            add(){
                this.name = '';
                this.description = '';
                this.edit = false;
                this.showModal = true;
            },

            editFood(food){
                this.food = food;
                this.edit = true;
                this.showModal = true;
            },

            close: function(){
                this.showModal = false;
                this.edit = false;
                this.loadFoods();
            },
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

    .border {
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