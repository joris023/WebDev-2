import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Home.vue';
import ProductList from '../components/products/ProductList.vue';
import CreateProduct from '../components/products/CreateProduct.vue';
import EditFood from '../components/products/EditFood.vue';
import EditDrink from '../components/products/EditDrink.vue';
import OrderList from '@/components/orders/OrderList.vue';
import OrderCheck from '../components/orders/OrderCheck.vue';
import Login from '../components/login/Login.vue'
import Register from '@/components/login/Register.vue';
import Menu from '@/components/menu/Menu.vue';
import FoodList from '@/components/menu/FoodList.vue';
import DrinkList from '@/components/menu/DrinkList.vue';
import Cart from '@/components/cart/Cart.vue';


const routes = [
  { path: '/', component: Home },


  //Login
  { path: '/login', component: Login},
  { path: '/register', component: Register},

  //USER - Menu
  { path: '/menu', component: Menu },
  { path: '/foodlist', component: FoodList },
  { path: '/drinklist', component: DrinkList },

  //USER - Cart
  { path: '/cart', component: Cart },

  //ADMIN - Products
  { path: '/products', component: ProductList },
  { path: '/createproduct', component: CreateProduct },
  { path: '/editfood/:id', component: EditFood, props: true  },
  { path: '/editdrink/:id', component: EditDrink, props: true  },
  
  //ADMIN - Orders
  { path: '/orders', component: OrderList},
  { path: '/ordercheck/:id', component: OrderCheck, props: true},

];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes
})

export default router
