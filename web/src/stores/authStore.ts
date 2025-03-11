import { ref } from 'vue';
import { type User } from '@/interfaces/user';
import { defineStore } from "pinia";
import { authService } from '@/services/authService';

export const useAuthStore = defineStore('auth', () => {
  const user = ref<User | null>(null)

  const me = async () => {
    try {
      const data = await authService.me()
      user.value = data.user
    } catch (error) {
      console.error(error)
      user.value = null
    }
  }

  const signIn = async (email: string, password: string) => {
    try {
      const data = await authService.signIn(email, password)
      user.value = data.user
    } catch (error) {
      console.error(error)
      user.value = null
    }
  }

  const signUp = async (name: string, email: string, password: string) => {
    try {
      const data = await authService.signUp(name, email, password)
      user.value = data.user
    } catch (error) {
      console.error(error)
      user.value = null
    }
  }

  const signOut = async () => {
    try {
      const data = await authService.signOut()
      user.value = null
    } catch (error) {
      console.error(error)
    }
  }

  return {
    user,
    me,
    signIn,
    signUp,
    signOut
  }
})
