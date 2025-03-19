<script setup>
// import axios from '../axios';
import { useLoginStore } from '@/stores/LoginStore';
import axios from '../../BaseURL';
import { ref } from 'vue';
import { useRouter } from 'vue-router'

const router = useRouter();
const loginStore = useLoginStore();

const credentials = ref({
  email: "",
  password: ""
});

const isLoading = ref(false); 
const showWhologgedIn = ref("");

async function login() {
    isLoading.value = true;
    showWhologgedIn.value = "";

    const success = await loginStore.login(credentials.value.email, credentials.value.password);

    if (success) {
        router.push('/login'); // Redirect after login
    } else {
      showWhologgedIn.value = "Invalid credentials. Please try again.";
    }

    isLoading.value = false;
}

function register(){
    router.push('/register');
}
</script>

<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h2>Login</h2>
          </div>
          <div class="card-body">
            <form @submit.prevent="login">
              <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" v-model="credentials.email" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">Password:</label>
                <input type="password" v-model="credentials.password" class="form-control" required />
              </div>

              <button type="submit" class="btn btn-primary w-100">
                <span v-if="isLoading">⏳ Loading...</span>
                <span v-else>Login</span>
              </button>&nbsp;&nbsp;
              <button @click="register()" class="btn btn-warning w-100">
                Register
              </button>
            </form>

            <div class="mt-3 text-center">
              <p v-if="showWhologgedIn === 'customer'" class="alert alert-success">Logged in as Customer</p>
              <p v-if="showWhologgedIn === 'admin'" class="alert alert-info">Logged in as Admin</p>
              <p v-if="showWhologgedIn === 'unknown'" class="alert alert-warning">Login failed</p>
              <p v-if="showWhologgedIn === 'error'" class="alert alert-danger">An error occurred. Please try again.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
