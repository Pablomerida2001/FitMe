<template>
    <div class="profile-container">
        <div class="user-info">
            <h2>{{user.name}}</h2>
            <p>{{user.email}}</p>
        </div>
        
    </div>
</template>

<script>
    export default{
        props:[
            'user',
        ],
        data: function(){
            return{
                date: new Date().toISOString().slice(0, 10),
            }
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
    .profile-container{
        width: 80%;
        margin: 0 auto;
        min-height: 600px;
        background-color: #f1f1f1;
        border: 1px solid grey;
    }

    .user-info{
        width: 100%;
        height: 100px;
        background-color: #a6a2a2;
        display: flex;
        justify-content: center;
        flex-direction: column;    
    }   
</style>