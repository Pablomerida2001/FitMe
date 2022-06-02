<template>
    <div class="recipe">
        <div class="recipe-info">
            <h1 class="recipe-tittle" @click="close">{{recipe.name}}</h1>
            <h3>Descripción</h3>
            <p>{{recipe.description}}</p>
            <h3>Ingredientes</h3>
            <div v-for="food in foods">
                <h5>- {{food.name}}, {{food.pivot.quantity}}grs.</h5>
            </div>
            <h3>Información nutricional</h3>
            <a>{{translations["totalCal"]}}: {{calories.toFixed(0)}}Kcal | {{translations["protein"]}}: {{protein.toFixed(2)}}gr | {{translations["carbs"]}}: {{carbs.toFixed(2)}}gr | {{translations["fat"]}}: {{fats.toFixed(2)}}gr </a>
        </div>
    </div> 
</template>

<script>
    export default{
        props:[
            'userid',
            'translations',
            'recipe',
            'foods',
            'calories',
            'protein',
            'carbs',
            'fats',
        ],

        data: function(){
            return{
            }
        },

        mounted(){
            this.load();
        },

        methods:{
            load: function(){
                
            },

            close(){
                this.$emit('close');
            }
        }
    }
</script>
<style>
    .recipe{
        position: absolute; 
        top: 8%; 
        left: 0%;
        z-index: 10;
        height: 92%;
        width: 100%;
        background-color: white;
    }

   .recipe-info{
        margin: 0 auto;
        width: 80%;
        height: 100%;
        background-color: #f1f1f1;
        border: 1px solid grey;
        margin-bottom: 15px;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .recipe-tittle{
        margin: 0 auto;
        font-style: bold;
        margin-bottom: 3%;
    }

    .recipe-info h3{
        margin-top: 3%;
    }
</style>