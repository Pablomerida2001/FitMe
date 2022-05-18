<template>
    <div>
        <h3>{{translations['tittle']}}</h3>
        <span class="span-container">
            <VueDatePicker v-model="date" format="DD-MM-YYYY" />
            <button class="btn btn-primary addBtn" @click="add">{{translations["add"]}}</button>
        </span>
        <div v-for="item in exercises">
            <exercise :userid="userid" :translations="translations" :Exercise="item"></exercise>
        </div>
        <add-exercise v-show="showModal" :initialDate="date" @eventname="close" :userid="userid" :translations="translations"></add-exercise>
    </div>
</template>

<script>
    import exercise from './Exercise.vue';
    import addExercise from './AddExercise.vue';
    import { VueDatePicker } from '@mathieustan/vue-datepicker';
    import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css';

    export default{
        props:[
            'userid',
            'translations'
        ],

        data: function(){
            return{
                date: new Date().toISOString().slice(0, 10),
                exercises: [],
                showModal: false,
            }
        },
        watch: {
            date(newDate, oldDate) {
                this.load();
            }
        },

        components:{
            VueDatePicker,
            exercise,
            addExercise
        },

        mounted(){
            this.load();
        },

        methods:{
            load: function(){
                //request to the API
                axios.get('api/exercise/workout', {
                    params: {
                        user: String(this.userid),
                        date: this.date
                    }
                }).then((response)=>{
                    this.exercises = response.data;
                    console.log(response.data)
                }).catch();
            },

            add: function(){
                this.showModal = true;
            },

            close: function(){
                this.showModal = false;
                this.load();
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
</style>