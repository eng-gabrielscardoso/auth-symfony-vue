<script setup lang="ts">
import { ref } from "vue";
import { useAuthStore } from "@/stores/authStore";
import { useRouter } from "vue-router";

const authStore = useAuthStore();
const router = useRouter();

const email = ref("");
const password = ref("");
const loading = ref(false);
const errorMessage = ref("");

const handleLogin = async () => {
  errorMessage.value = "";
  loading.value = true;

  try {
    await authStore.signIn(email.value, password.value);
    router.push("/dashboard");
  } catch (error) {
    errorMessage.value = "Invalid email or password.";
  } finally {
    loading.value = false;
  }
};
</script>

<template>
  <div class="flex justify-center items-center min-h-screen">
    <div class="card w-96 bg-base-200 shadow-lg p-6">
      <h2 class="text-2xl font-bold text-center">Login</h2>

      <div class="form-control mt-4">
        <label class="label">
          <span class="label-text">Email</span>
        </label>
        <input
          v-model="email"
          type="email"
          placeholder="Enter your email"
          class="input input-bordered w-full"
          required
        />
      </div>

      <div class="form-control mt-4">
        <label class="label">
          <span class="label-text">Password</span>
        </label>
        <input
          v-model="password"
          type="password"
          placeholder="Enter your password"
          class="input input-bordered w-full"
          required
        />
      </div>

      <button
        @click="handleLogin"
        class="btn btn-primary mt-4 w-full"
        :disabled="loading"
      >
        {{ loading ? "Logging in..." : "Login" }}
      </button>

      <p v-if="errorMessage" class="text-red-500 text-sm mt-2 text-center">
        {{ errorMessage }}
      </p>
    </div>
  </div>
</template>
