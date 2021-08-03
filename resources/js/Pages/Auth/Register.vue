<template>
    <app-layout>
        <!-- form wrapper -->
        <div class="container py-16">
            <div class="max-w-lg mx-auto bg-white shadow border px-6 py-7 rounded overflow-hidden">
                <h2 class="text-2xl uppercase font-medium mb-1">Create an account</h2>
                <p class="text-gray-600 mb-6 text-sm">
                    Register here if you don't have an account
                </p>

                <jet-validation-errors class="mb-4" />

                <form @submit.prevent="submit">
                    <div class="space-y-4">
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Full Name <span class="text-primary">*</span>
                            </label>
                            <input type="text" class="input-box" v-model="form.name">
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Email Address <span class="text-primary">*</span>
                            </label>
                            <input type="email" class="input-box" v-model="form.email">
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">Password
                                <span class="text-primary">*</span>
                            </label>
                            <input type="password" class="input-box" v-model="form.password">
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">Confirm Password
                                <span class="text-primary">*</span>
                            </label>
                            <input type="password" class="input-box" v-model="form.password_confirmation">
                        </div>
                    </div>
                    <div class="flex items-center mt-6" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                        <input type="checkbox" id="terms" class="text-primary focus:ring-0 rounded-sm cursor-pointer" v-model="form.terms">
                        <label for="terms" class="text-gray-600 ml-3 cursor-pointer">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </label>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create Account
                        </button>
                    </div>
                </form>
                <p class="mt-4 text-gray-600 text-center">
                    Already have an account? <inertia-link :href="route('login')" class="text-primary">Login Now</inertia-link>
                </p>
            </div>
        </div>
        <!-- form wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    name: "Register",

    components: {
        AppLayout,
        JetValidationErrors,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
