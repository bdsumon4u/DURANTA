<template>
    <app-layout>
        <!-- form wrapper -->
        <div class="container py-16">
            <div class="max-w-lg mx-auto bg-white shadow border px-6 py-7 rounded overflow-hidden">
                <h2 class="text-2xl uppercase font-medium mb-2">
                    LOGIN
                </h2>

                <jet-validation-errors class="mb-4" />

                <p v-if="status" class="text-green-600 mb-6 text-sm">
                    {{ status }}
                </p>
                <form @submit.prevent="submit">
                    <div class="space-y-4">
                        <div>
                            <label for="phone" class="text-gray-600 mb-2 block">
                                Phone <span class="text-primary">*</span>
                            </label>
                            <input id="phone" type="text" class="input-box" v-model="form.phone">
                        </div>
                        <div>
                            <label for="password" class="text-gray-600 mb-2 block">
                                Password <span class="text-primary">*</span>
                            </label>
                            <input id="password" type="password" class="input-box" v-model="form.password">
                        </div>
                    </div>
                    <div class="md:flex items-center justify-between mt-6">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="remember" name="remember" class="text-primary focus:ring-0 rounded-sm cursor-pointer" v-model="form.remember">
                            <label for="remember" class="text-gray-600 ml-3 cursor-pointer">
                                Remember Me
                            </label>
                        </div>
                        <inertia-link v-if="canResetPassword" :href="route('password.request')" class="hover:underline text-sm text-primary">
                            Forgot your password?
                        </inertia-link>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Login
                        </button>
                    </div>
                </form>

                <!-- login with social -->
                <template v-if="false">
                    <div class="mt-6 flex justify-center relative">
                        <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>
                        <div class="text-gray-600 uppercase px-3 bg-white relative z-10">
                            OR LOGIN IN WITH
                        </div>
                    </div>
                    <div class="mt-4 flex gap-4">
                        <a href="#"
                           class="block w-1/2 py-2 text-center text-white bg-blue-800 rounded uppercase font-roboto font-medium text-sm">
                            Facebook
                        </a>
                        <a href="#"
                           class="block w-1/2 py-2 text-center text-white bg-yellow-600 rounded uppercase font-roboto font-medium text-sm">
                            Google
                        </a>
                    </div>
                </template>
                <!-- login with social end -->

                <p class="mt-4 text-gray-600 text-center">
                    Don't have an account? <inertia-link :href="route('register')" class="text-primary">Register Now</inertia-link>
                </p>
            </div>
        </div>
        <!-- form wrapper end -->
    </app-layout>
</template>

<script>
import JetValidationErrors from '@/Jetstream/ValidationErrors'
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "Login",

    components: {
        AppLayout,
        JetValidationErrors,
    },

    props: {
        canRegister: Boolean,
        canResetPassword: Boolean,
        status: String
    },

    data() {
        return {
            form: this.$inertia.form({
                phone: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ... data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
        }
    },

    created() {
        this.makeTitle(this.$page.props.settings.general.site_name + ' | Login')
    }
}
</script>
