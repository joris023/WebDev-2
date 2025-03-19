<script setup>
import OrderListItem from "./OrderListItem.vue";
import { ref, onMounted } from 'vue';
import axios from 'axios';

const orders = ref([])

async function getOrders() {
  try {
    const response = await axios.get('http://localhost/order');
    orders.value = response.data
  }
  catch (error) {
    console.error("Error try to fetch orders: ", error);
  }
}


onMounted(() => {
    getOrders();
});

function removeOrder(id) {
  orders.value = orders.value.filter(order => order.id !== id);
}

</script>

<template>
    <section>
      <div class="container">
        <h2 class="mt-3 mt-lg-5">Orders</h2>
          <button type="button" class="btn btn-primary mt-3" @click="$router.push('/createproduct');">
              Add menu item
            </button>
        <div class="row mt-3">
          <h1 class="mt-5">Food</h1>
          <OrderListItem
            v-for="order in orders"
            :key="order.id"
            :order="order"
            @orderDeleted="removeOrder"
          />
        </div>
      </div>
    </section>
  </template>
  
  <style>
  </style>