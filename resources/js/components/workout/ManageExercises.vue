<template>
    <div>
        <button class="btn btn-primary addBtn" @click="add">{{translations["add"]}}</button>        
        <span class="span-container">
            <table class="admin-table">
                <th>{{translations['name']}}</th>
                <th>{{translations['description']}}</th>
                <th>{{translations['options']}}</th>
                <template v-for="exercise in exercises">
                    <tr>
                        <td>
                            {{exercise.name}}
                        </td>
                        <td>
                            {{exercise.description}}
                        </td>
                        <td>
                            <button class="btn btn-primary addBtn" @click="editExercise(exercise)">{{translations["edit"]}}</button>        
                            <button class="admin-table-btn" @click="deleteExercise(exercise)"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </template>
            </table>
            <create-exercise v-show="showModal" @eventname="close" :userid="userid" :translations="translations" :edit="edit" :exerciseName="name" :exerciseDesctiprion="description" :exercise="id"></create-exercise>
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
                exercises: [],
                showModal: false,
                name: '',
                description: '',
                edit: false,
                id: ''
            }
        },

        mounted(){
            this.loadExercises();
        },

        methods:{
            loadExercises: function(){
                //request to the API
                axios.get('api/exercise/getAllExercises', {}).then((response)=>{
                    this.exercises = response.data;
                }).catch();
            },

            deleteExercise: function(exercise){
                axios.delete('api/admin/exercise/deleteExercise', {data: {
                    exercise: exercise.id,
                }});

                this.loadExercises();
            },

            updateExercise: function(exercise){

            },
            
            add(){
                this.name = '';
                this.description = '';
                this.edit = false;
                this.showModal = true;
            },

            editExercise(exercise){
                this.name = exercise.name;
                this.description = exercise.description;
                this.id = exercise.id;
                this.edit = true;
                this.showModal = true;
            },

            close: function(){
                this.showModal = false;
                this.edit = false;
                this.loadExercises();
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