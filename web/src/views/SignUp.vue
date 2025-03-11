<script setup lang="ts">
import { ref } from "vue";
import { useAuthStore } from "@/stores/authStore";
import { useRouter } from "vue-router";
import { signupSchema } from "@/schemas/auth";
import { z } from "zod";

const authStore = useAuthStore();
const router = useRouter();

const name = ref("");
const email = ref("");
const password = ref("");
const loading = ref(false);
const errorMessage = ref("");
const formErrors = ref<{ [key: string]: string }>({});

const handleSignUp = async () => {
  errorMessage.value = "";
  formErrors.value = {};
  loading.value = true;

  try {
    const result = signupSchema.safeParse({ name: name.value, email: email.value, password: password.value });

    if (!result.success) {
      result.error.errors.forEach((error) => {
        formErrors.value[error.path[0]] = error.message;
      });
      loading.value = false;
      return;
    }

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
        <p v-if="formErrors.name" class="text-red-500 text-sm mt-1">{{ formErrors.name }}</p>
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
        <p v-if="formErrors.email" class="text-red-500 text-sm mt-1">{{ formErrors.email }}</p>
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
        <p v-if="formErrors.password" class="text-red-500 text-sm mt-1">{{ formErrors.password }}</p>
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
