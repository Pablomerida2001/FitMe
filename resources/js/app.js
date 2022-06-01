/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import store from './store/index';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('consumed-foods', require('./components/foods/ConsumedFoods.vue').default);
Vue.component('meals', require('./components/foods/Meal.vue').default);
Vue.component('manage-foods', require('./components/foods/ManageFoods.vue').default);
Vue.component('add-food', require('./components/foods/AddFood.vue').default);
Vue.component('profile', require('./components/profile/Profile.vue').default);
Vue.component('add-weight', require('./components/profile/AddWeight.vue').default);
Vue.component('update-calories', require('./components/profile/UpdateCalories.vue').default);
Vue.component('create-food', require('./components/foods/CreateFood.vue').default);
Vue.component('workouts', require('./components/workout/Workouts.vue').default);
Vue.component('exercise', require('./components/workout/Exercise.vue').default);
Vue.component('add-exercise', require('./components/workout/AddExercise.vue').default);
Vue.component('create-exercise', require('./components/workout/CreateExercise.vue').default);
Vue.component('manage-exercises', require('./components/workout/ManageExercises.vue').default);
Vue.component('recipes', require('./components/Recipes/Recipes.vue').default);
Vue.component('recipe-card', require('./components/Recipes/RecipeCard.vue').default);
Vue.component('recipe', require('./components/Recipes/Recipe.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
