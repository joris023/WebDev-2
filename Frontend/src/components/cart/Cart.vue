<script setup>
import CartItem from './CartItem.vue';
import axios from '../../BaseURL';
import { useRouter } from 'vue-router'
import { ref, onMounted } from 'vue';
import { useCartStore } from '@/stores/CartStore';
import { computed } from 'vue';

const Cart = useCartStore();

// const products = ref([])

const products = computed(() => Cart.getCart)
const total = computed(() => Cart.getTotal)

// function getAllCartItems() {
//     products.value = Cart.getCart
// }

// onMounted(() => {
//     getAllCartItems();
// })

const order = ref({
    user_id: 1,
    table_number: 5,
    total_amount: total
});

async function checkOut() {
    try{
        const response = await axios.post('/order', order.value);
        console.log(response.data.id)
        products.value.forEach(item => {
            if(item.type == "food") {
                console.log("food" + item.name + item.id + item.quantity);
            }
            else if (item.type == "drink"){
                console.log("drink" + item.name);
            }
        });

        Cart.clearCart()
    } catch (error) {
        console.error(error);
    }
}

</script>
<template>
    <section>
      <div class="container">
        <div class="d-flex  mt-3 mt-lg-5">
          <h2 class="fw-bold flex-grow-1">Cart</h2>
        </div>

        <div class="row mt-3">
          <CartItem
            v-for="product in products"
            :key="product.id"
            :product="product"
          />
        </div>
        <div class="d-flex justify-content-end align-items-center mt-3 mt-lg-5">
            <h2 class="fw-bold me-3">Total = {{ Cart.getTotal }}</h2> <!-- ✅ Pushes text closer to the button -->
            <button class="btn btn-success" @click="checkOut">Checkout</button>
        </div>

      </div>
    </section>
</template>
<style>
</style>