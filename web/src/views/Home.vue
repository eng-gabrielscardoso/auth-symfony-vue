<template>
  <div class="card bg-base-200 text-primary-content w-96">
    <div class="card-body">
      <h2 class="card-title">Hey there</h2>
      <p>
        This is the Auth+Symfony+Vue project. Below follow the links to register or login in the application.
      </p>
      <div class="card-actions justify-end">
        <router-link to="/sign-in" is="button" class="btn btn-primary">Login</router-link>
      </div>
      <div class="card-actions justify-end">
        <router-link to="/sign-up" is="button" class="btn btn-secondary">Register</router-link>
      </div>
    </div>
  </div>
</template>
