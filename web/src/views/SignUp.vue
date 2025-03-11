<script setup lang="ts">
import { ref } from "vue";
import { useAuthStore } from "@/stores/authStore";
import { useRouter } from "vue-router";

const authStore = useAuthStore();
const router = useRouter();

const name = ref("");
const email = ref("");
const password = ref("");
const loading = ref(false);
const errorMessage = ref("");

const handleSignUp = async () => {
  errorMessage.value = "";
  loading.value = true;

  try {
    await authStore.signUp(name.value, email.value, password.value);
    router.push("/dashboard");
  } catch (error) {
    errorMessage.value = "Error creating account. Please check your details.";
  } finally {
    loading.value = false;
  }
};
</script>

<template>
  <div class="flex justify-center items-center min-h-screen">
    <div class="card w-96 bg-base-200 shadow-xl p-6">
      <h2 class="text-2xl font-bold text-center">Sign Up</h2>

      <div class="form-control mt-4">
        <label class="label">
          <span class="label-text">Name</span>
        </label>
        <input
          v-model="name"
          type="text"
          placeholder="Enter your name"
          class="input input-bordered w-full"
          required
        />
      </div>

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
        @click="handleSignUp"
        class="btn btn-primary mt-4 w-full"
        :disabled="loading"
      >
        {{ loading ? "Signing up..." : "Sign Up" }}
      </button>

      <p v-if="errorMessage" class="text-red-500 text-sm mt-2 text-center">
        {{ errorMessage }}
      </p>
    </div>
  </div>
</template>
