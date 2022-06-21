<template>
  <div class="modal-overlay">
    <div class="modal">
        <a class="close" @click="close">X</a>
        <h6>{{translations["add new"]}}</h6>

        <label class="quantityLabel" for="quantity">{{translations["weight"]}}</label>
        <input v-model="weight" class="input" id="quantity" type="number"/>

        <label class="label" for="datePicker">{{translations["date"]}}</label>
        <VueDatePicker v-model="date" format="DD-MM-YYYY" class="input" id="datePicker"/>
        <button @click="add" class="save-btn">{{translations["add"]}}</button>
    </div>
  </div>
</template>

<script>
    import { VueDatePicker } from '@mathieustan/vue-datepicker';
    import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css';

    export default{
        props:[
            'initialDate',
            'userid',
            'translations',
            'currentWeight',
        ],

        watch: {
            initialDate(newDate, oldDate) {
                this.date = this.initialDate;
            },

            currentWeight(){
                this.weight = this.currentWeight;
            }
        },

        data: function(){
            return{
                weight: 0,
                date: this.initialDate,
            }
        },

        mounted() {
            this.weight = this.currentWeight;
        },

        methods:{
            add: function(){
                axios.post('api/profile/addWeight', {
                    user: String(this.userid),
                    weight: this.weight,
                    date: this.date,
                }).catch(e=>{
                    console.log(e.response);
                }).then(()=>{
                    this.$emit('eventname');
                });
            },

            close: function(){
                this.$emit('eventname');
            }
        }
    }
</script>

<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        background-color: #000000da;
    }

    .modal {
        text-align: center;
        background-color: white;
        height: 650px;
        width: 550px;
        margin: auto;
        padding: 60px 0;
        border-radius: 20px;
        display: block;
        position: relative
    }
    .close {
        position: relative;
        top: -7%;
        right: -44%;
        color: black;
        cursor: pointer;
    }

    .close:hover {
        color: red;
    }

    h6 {
        font-weight: 500;
        font-size: 28px;
        margin: 20px 0;
    }

    p {
        font-size: 16px;
        margin: 20px 0;
    }

    .save-btn {
        background-color: green;
        width: 150px;
        height: 40px;
        color: white;
        font-size: 14px;
        border-radius: 16px;
        margin-top: 50px;
    }

    .quantityLabel{
        margin-top: 5%;
        position: relative;
        left: -32%;
        margin-bottom: 5px;
    }

    .input{
        margin: 0 auto;
        display: block;
        width: 80%;
    }

    .select{
        margin: 0 auto;
        display: block;
        width: 80%;
        padding: 0.375rem 2.25rem 0.375rem 0.75rem;
        -moz-padding-start: calc(0.75rem - 3px);
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        background-color: #f8fafc;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .label{
        margin-top: 5%;
        position: relative;
        left: -36%;
        margin-bottom: 5px;
    }

    .foodSeparator{
        width: 80%;
        margin: 0 auto;
    }

    .foodName{
        margin-top: 15px;
    }

    .foodDescription{
        font-size: 13px;
        margin-top: 5px;
        margin-bottom: 10px;
    }
</style>