<script setup>
import { useLoginStore } from '@/stores/LoginStore';

const loginStore = useLoginStore();
</script>

<template>
    <section>
        <div class="container">
            <h2 class="mt-3 mt-lg-5">Welcome {{ loginStore.getFirstname }}</h2> <!-- ✅ Call as function -->
        </div>
    </section>
</template>
