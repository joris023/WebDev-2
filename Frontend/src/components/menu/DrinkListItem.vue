<script setup>
import { useCartStore } from '@/stores/CartStore';
import axios from 'axios';
import { ref, defineProps } from 'vue'

const Cart = useCartStore();


defineProps({
    product: Object
})

function addToCart(id) {
    Cart.addToCart(id, "drink");
}

</script>

<template>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xxl-3 p-2">
        <div class="card product-card h-100">
            <div class="card-body">
                <img v-if="product.image" :src="product.image" width="100%" height="100" />
                <img v-else src="/images/default.jpg" width="100%" height="100"/>
                <div class="float-start">
                    <!-- <p>{{ product.id }}</p> -->
                    <p>{{ product.name }}</p>
                    <p>
                        <small>{{ product.description }}</small>
                    </p>
                </div>
                <span class="price float-end">{{ product.price }}</span>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" @click="addToCart(product.id)"> Add to Cart </button>
            </div>
        </div>
    </div>
</template>

<style>
</style>