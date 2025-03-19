import { ref } from 'vue';
import axios from '../BaseURL';
import { defineStore } from 'pinia';

export const useLoginStore = defineStore('login', {
    state: () => ({
        jwt: localStorage.getItem("jwt") || "",
        firstname: localStorage.getItem("firstname") || "",
        role: "",
        error: null,
        isloading: false
        //LOADING VALUE TOEVOEGEN
    }),

    actions: {
        async login(email, password) {
            try {
                const response = await axios.post(`http://localhost/login`, {
                    email,
                    password
                });

                axios.defaults.headers.common['Authorization'] = "Bearer " + response.data;
                localStorage.setItem("jwt", response.data); // Store token
                localStorage.setItem("firstname", email);

                console.log("Login Successful:", response.data);
                return true; // Success
            } catch (error) {
                console.error("Login Failed:", error);
                return false; // Failed
            }
        },

        logout() {
            this.jwt = "";
            localStorage.removeItem("jwt");
            this.firstname = "";
            localStorage.removeItem("firstname");
            delete axios.defaults.headers.common['Authorization'];
        }
    },

    getters: {
        isLoggedIn: (state) => !!state.jwt,
        getFirstname: (state) => state.firstname,
        isAdmin: (state) => state.role == "admin",
    },
});
