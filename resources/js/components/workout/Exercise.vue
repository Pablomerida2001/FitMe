
<template>
    <div>
        <button class="collapsible">{{Exercise.name}} <p class="text-btn">{{sets.length}} {{translations['sets']}}</p></button>
        <div class="content">
            <div class="set-content" v-for="(set, index) in sets">
                <label for="repsInput">{{translations["reps"]}}</label>
                <input v-model="set.reps" id="repsInput" style="margin-right: 50px" type="number"/>
                <label for="weightInput">{{translations["weight"]}}</label>
                <input v-model="set.weight" id="weightInput" style="margin-right: 50px" type="number"/>
                <button class="btn btn-primary addBtn" @click="save(index)">{{translations["save"]}}</button>
            </div>
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
        },

        methods:{
            load: function(){
                axios.get('api/exercise/getExerciseSets', {
                    params: {
                        workoutId: this.Exercise.pivot.id,
                    }
                }).then((response)=>{
                    this.sets = response.data;
                    console.log(this.sets)
                }).catch();


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

            deleteExercise: function(food){
                axios.delete('api/foods/removeExercise', {data: {
                    exercise: Exercise.id,
                    user: String(this.userid),
                    date: this.date,
                }});

                this.$emit('update');
            },

            save: function(index){

                console.log(this.sets[index])
                axios.post('api/exercise/updateSet', {
                    set: this.sets[index].id,
                    reps: this.sets[index].reps,
                    weight: this.sets[index].weight,
                });
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
        display: flex;
        flex-direction: column;
    }

    .text-btn{
        display: inline;
        float: right;
        right: 15%;
        position: relative;
        margin: 0;
    }

    .set-content{
        display: block;
        padding: 20px;
        margin: 0 auto;
    }
</style>