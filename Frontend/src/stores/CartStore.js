import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
    state: () => ({
        cart: JSON.parse(localStorage.getItem("cart")) || [],
    }),

    actions: {
        addToCart(productId, productName, price, type) {
            const existingItem = this.cart.find(item => item.id == productId && item.type == type);
            
            if (existingItem) {
                existingItem.quantity += 1; 
            } else {
                this.cart.push({ id: productId, name: productName, price: price, quantity: 1, type: type});
            }

            this.saveCart();
        },

        addQuantity(productId, type) {
            const item = this.cart.find(item => item.id == productId && item.type == type);
            if (item) {
                item.quantity += 1;
                this.saveCart();
            }
        },

        removeQuantity(productId, type) {
            const item = this.cart.find(item => item.id == productId && item.type == type);
            if (item && item.quantity > 1) {
                item.quantity -= 1;
                this.saveCart();
            }
        },

        removeFromCart(productId, type) {
            this.cart = this.cart.filter(item => item.id !== productId || item.type !== type); // ✅ Remove item
            this.saveCart();
        },

        clearCart() {
            this.cart = [];
            localStorage.removeItem("cart");
        },

        saveCart() {
            localStorage.setItem("cart", JSON.stringify(this.cart)); 
        }
    },

    getters: {
        getCart: (state) => state.cart, 
        getTotal: (state) => {
            let total = 0;
            state.cart.forEach(item => {
                total += item.price * item.quantity;
            });
            return total.toFixed(2); // ✅ Ensure price has 2 decimal places
        }
    },
});
