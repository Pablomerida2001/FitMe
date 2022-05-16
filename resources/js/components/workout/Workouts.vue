<template>
    <div>
        <h3>Workout</h3>
        <span class="span-container">
            <VueDatePicker v-model="date" format="DD-MM-YYYY" />
        </span>
    </div>
</template>

<script>
    import { VueDatePicker } from '@mathieustan/vue-datepicker';
    import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css';

    export default{
        props:[
            'userid',
        ],

        data: function(){
            return{
                date: new Date().toISOString().slice(0, 10),
            }
        },
        watch: {
            date(newDate, oldDate) {
                this.loadFoods();
            }
        },

        components:{
            VueDatePicker,
        },

        mounted(){
            this.load();
        },

        methods:{
            load: function(){
                
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
</style>