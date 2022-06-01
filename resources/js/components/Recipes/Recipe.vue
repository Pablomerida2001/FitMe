<template>
    <div class="">
        <h4 class="link">{{recipe.name}}</h4>
        <p>{{recipe.description | truncate(220, '...')}}</p>
        <a>Total Calories: {{calories.toFixed(0)}}Kcal | Protein: {{protein.toFixed(2)}}gr | Carbohydrates: {{carbs.toFixed(2)}}gr | Fat: {{fats.toFixed(2)}}gr </a>
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
        watch: {
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

        mounted(){
            this.load();
        },

        methods:{
            load: function(){
                
            },
        }
    }
</script>
<style>
   .recipe-container{
        width: 80%;
        margin: 0 auto;
        background-color: #f1f1f1;
        border: 1px solid grey;
        margin-bottom: 15px;
        padding: 20px
    }
</style>