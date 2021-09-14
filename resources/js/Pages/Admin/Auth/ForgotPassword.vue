<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="phone" value="Phone" />
                <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required autofocus />
            </div>

            <div v-if="status" id="otp" class="flex flex-row justify-center text-center px-2 mt-5">
                <template v-for="i in [1, 2, 3, 4, 5, 6]">
                    <input :ref="`item_${i}`" @input.prevent="ev => handleInput(ev, i)" @keydown.delete="ev => handleDelete(ev, i)" class="m-1 border h-10 w-10 text-center form-control rounded" type="text" :id="`item-${i}`" maxlength="1" :autofocus="i === 1" />
                </template>
            </div>
            <div class="flex justify-between items-center mt-5">
                <button type="button" class="flex items-center text-blue-700 hover:text-blue-900 cursor-pointer py-2 px-4 rounded-md border" :disabled="counting || form.processing" @click.prevent="submit">
                    <vue-countdown v-if="counting" :time="timer" @end="onCountdownEnd" v-slot="{ totalSeconds }">Retry {{ totalSeconds }}s Later.</vue-countdown>
                    <span v-else>{{ status ? 'Resend' : 'Send' }} OTP</span>
                </button>
                <a v-if="status" @click.prevent="change" class="cursor-pointer px-3 py-2 mx-1 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition">Submit</a>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'
import VueCountdown from "@chenfengyuan/vue-countdown";

export default {
    components: {
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetLabel,
        JetValidationErrors,
        VueCountdown,
    },

    props: {
        status: String
    },

    data() {
        return {
            token: null,
            timer: 120000,
            counting: this.status,
            form: this.$inertia.form({
                phone: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('admin.password.email'), {
                onFinish: () => {
                    this.counting = this.status;
                    this.token = null;
                },
            })
        },
        change() {
            this.$inertia.visit(route('admin.password.reset', {token: this.token, phone: this.form.phone}))
        },
        handleInput(ev, i) {
            const value = ev.target.value;

            if (value && i < 6) {
                i++;
            }

            this.handleToken();
            this.$refs[`item_${i}`].focus();
        },
        handleDelete(ev, i) {
            const value = ev.target.value;

            if (!value && i > 1) {
                i--;
            }

            this.handleToken();
            this.$refs[`item_${i}`].focus();
        },
        handleToken() {
            this.token = Array.from(Array(6), (element, i) => {
                return this.$refs[`item_${i + 1}`].value || '';
            }).join('');
        },
        onCountdownEnd() {
            this.counting = false;
        }
    },

    created() {
        this.makeTitle('Admin | Forgot Password')
    }
}
</script>
