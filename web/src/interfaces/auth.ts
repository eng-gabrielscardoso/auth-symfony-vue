import type { User } from "@/interfaces/user";

export interface MeResponse {
  user: User
}

export interface SignInResponse {
  user: User
  message: string
}

export interface SignUpResponse {
  user: User
  message: string
}

export interface SignOutResponse {
  message: string
}
