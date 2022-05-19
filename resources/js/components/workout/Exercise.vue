
<template>
    <div>
        <button class="collapsible">{{Exercise.name}} <p class="text-btn">{{sets.length}} {{translations['sets']}}</p></button>
        <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>
</template>

<script>
    export default{
        props:[
            'Exercise',
            'date',
            'userid',
            'translations'
        ],

        data: function(){
            return{
                sets: [],
            }
        },

        watch: {
            
        },

        mounted(){
            this.load();

            var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content = this.nextElementSibling;
                    if (content.style.maxHeight){
                    content.style.maxHeight = null;
                    } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                    } 
                });
            }
        },

        methods:{
            load: function(){
                 axios.get('api/exercise/getExerciseSets', {
                    params: {
                        workoutId: this.Exercise.pivot.id,
                    }
                    }).then((response)=>{
                        this.sets = response.data;
                    }).catch();
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
            }
        }
    }
</script>

<style>
    .collapsible {
        background-color: #a6a2a2;
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        margin-top: 20px
    }

    .active, .collapsible:hover {
        background-color: #919090;
    }

    .collapsible:after {
        content: '\002B';
        color: white;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .active:after {
        content: "\2212";
    }

    .content {
        padding: 0 18px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        background-color: #f1f1f1;
    }

    .text-btn{
        display: inline;
        float: right;
        right: 15%;
        position: relative;
        margin: 0;
    }
</style>