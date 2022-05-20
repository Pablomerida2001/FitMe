
<template>
    <div>
        <button class="collapsible">{{Exercise.name}} <button class="delete-btn top-btn" @click="deleteExercise()"><i class="bi bi-trash"></i></button> <p class="text-btn">{{sets.length}} {{translations['sets']}}</p></button>
        <div class="content">
            <div class="set-content" v-for="(set, index) in sets">
                <label for="repsInput">{{translations["reps"]}}</label>
                <input v-model="set.reps" id="repsInput" style="margin-right: 50px" type="number"/>
                <label for="weightInput">{{translations["weight"]}}</label>
                <input v-model="set.weight" id="weightInput" style="margin-right: 50px" type="number"/>
                <button class="btn btn-primary addBtn" @click="save(index)">{{translations["save"]}}</button>
                <button class="delete-btn" @click="deleteSet(set)"><i class="bi bi-trash"></i></button>
            </div>
            <button class="btn btn-primary" @click="addSet">{{translations['add']}}</button>
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
            Exercise() {
                this.load();
            }
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

                    var coll = document.getElementsByClassName("collapsible");
                    var i;

                    for (i = 0; i < coll.length; i++) {
                        var content = coll[i].nextElementSibling;
                        
                        if (content.style.maxHeight){
                            content.style.maxHeight = content.scrollHeight + "px";
                        }
                    }
                }).catch();                
            },

            deleteExercise: function(){
                axios.delete('api/exercise/removeExercise', {data: {
                    exercise: this.Exercise.id,
                    user: String(this.userid),
                    date: this.date,
                    workoutId: this.Exercise.pivot.id,
                }});

                this.$emit('update');
            },

            deleteSet: function(set){
                axios.delete('api/exercise/deleteSet', {data: {
                    set: set.id,
                }});

                this.$emit('update');
            },

            save: function(index){
                axios.post('api/exercise/updateSet', {
                    set: this.sets[index].id,
                    reps: this.sets[index].reps,
                    weight: this.sets[index].weight,
                });
            },

            addSet: function(){
                axios.post('api/exercise/addSet', {
                    workout: this.Exercise.pivot.id,
                });

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

    .delete-btn{
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
        margin-left: 20px
    }

    .top-btn{
        float: right;
        margin: 0;
        right: 27%;
        position: absolute;
    }
</style>