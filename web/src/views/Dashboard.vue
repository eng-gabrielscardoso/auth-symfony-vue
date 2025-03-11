<script setup lang="ts">
import { onMounted } from "vue";
import { useAuthStore } from "@/stores/authStore";

const authStore = useAuthStore();

onMounted(() => {
  authStore.me();
});

const handleLogout = async () => {
  await authStore.signOut();
};
</script>

<template>
  <div class="min-h-screen flex flex-col items-center p-6">
    <div class="navbar shadow-lg w-full max-w-4xl rounded-lg p-4">
      <div class="flex-1">
        <h1 class="text-2xl font-bold">Auth+Symfony+Vue</h1>
      </div>
      <div v-if="authStore.user" class="flex items-center gap-4">
        <span class="text-lg font-semibold">Hey there, {{ authStore.user.name }}</span>
        <button class="btn btn-error btn-sm" @click="handleLogout">Logout</button>
      </div>
    </div>

    <div class="card bg-white shadow-xl w-full max-w-4xl mt-6 p-6 text-center">
      <p v-if="authStore.user" class="text-lg text-gray-700">
        Welcome, <strong>{{ authStore.user.name }}</strong>!
      </p>
      <p v-else class="text-lg text-gray-600">Please sign-in in application to grant access to dashboard.</p>
    </div>
  </div>
</template>
