import { z } from "zod";

// Definindo o schema de validação
export const signInSchema = z.object({
  email: z
    .string()
    .email("Please enter a valid email address.")
    .nonempty("Email is required."),
  password: z
    .string()
    .min(6, "Password must be at least 6 characters.")
    .nonempty("Password is required."),
});

export type SignInInput = z.infer<typeof signInSchema>;

export const signupSchema = z.object({
  name: z.string().nonempty("Name is required."),
  email: z
    .string()
    .email("Please enter a valid email address.")
    .nonempty("Email is required."),
  password: z
    .string()
    .min(6, "Password must be at least 6 characters.")
    .nonempty("Password is required."),
});

export type SignUpInput = z.infer<typeof signupSchema>;

