<script setup>
import FoodListItem from "./FoodListItem.vue";
import DrinkListItem from "./DrinkListItem.vue";
import { ref, onMounted } from 'vue';
import axios from '../../BaseURL';

const foods = ref([])
const drinks = ref([])

async function getFoods() {
  try {
    const response = await axios.get('http://localhost/food');
    foods.value = response.data
  }
  catch (error) {
    console.error("Error try to fetch foods: ", error);
  }
}

async function getDrinks() {
  try {
    const response = await axios.get('http://localhost/drink');
    drinks.value = response.data
  }
  catch (error) {
    console.error("Error try to fetch drinks: ", error);
  }
}

onMounted(() => {
    getFoods();
    getDrinks();
});

function removeFood(id) {
  foods.value = foods.value.filter(food => food.id !== id);
}

function removeDrink(id) {
  drinks.value = drinks.value.filter(drink => drink.id !== id);
}

</script>

<template>
    <section>
      <div class="container">
        <h2 class="mt-3 mt-lg-5">Menu</h2>
          <button type="button" class="btn btn-primary mt-3" @click="$router.push('/createproduct');">
              Add menu item
            </button>
        <div class="row mt-3">
          <h1 class="mt-5">Food</h1>
          <FoodListItem
            v-for="food in foods"
            :key="food.id"
            :food="food"
            @productDeleted="removeFood"
          />
          <h1 class="mt-5">Drink</h1>
          <DrinkListItem
            v-for="drink in drinks"
            :key="drink.id"
            :drink="drink"
            @drinkDeleted="removeDrink"
          />

        </div>
      </div>
    </section>
  </template>
  
  <style>
  </style>