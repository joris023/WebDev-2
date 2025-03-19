<script setup>
import { useLoginStore } from '@/stores/LoginStore';

const login = useLoginStore();

function Logout() {
    login.logout();
}

</script>

<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4 sticky-top">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <router-link to="/" class="nav-link" active-class="active">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/products" class="nav-link" active-class="active">Managemenu</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/orders" class="nav-link" active-class="active">Orders</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/login" class="nav-link" active-class="active">Login</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/menu" class="nav-link" active-class="active">Menu</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/cart" class="nav-link" active-class="active">Cart</router-link>
                </li>
                <li class="nav-item">
                    <button @click="Logout()">Logout</button>
                </li>
            </ul>
        </div>
    </nav>
</template>

<style>
</style>