import { http } from "@/http"
import type { MeResponse, SignInResponse, SignOutResponse, SignUpResponse } from "@/interfaces/auth"

export const authService = {
  async me(): Promise<MeResponse> {
    const { data } = await http.get('/auth/me', { withCredentials: true })

    return data.data as MeResponse
  },

  async signIn(email: string, password: string): Promise<SignInResponse> {
    const { data } = await http.post('/auth/sign-in', { email, password }, { withCredentials: true })

    return data.data as SignInResponse
  },

  async signUp(name: string, email: string, password: string): Promise<SignUpResponse> {
    const { data } = await http.post('/auth/sign-up', { name, email, password }, { withCredentials: true })

    return data.data as SignUpResponse
  },

  async signOut(): Promise<SignOutResponse> {
    const { data } = await http.post('/auth/sign-out', {}, { withCredentials: true })

    return data.data as SignOutResponse
  },
}
