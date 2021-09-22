<template>
    <app-layout>
        <div class="px-2 py-4 md:my-10 md:py-10">
            <form>
                <div class="max-w-sm mx-auto md:max-w-lg">
                    <div class="w-full">
                        <div class="bg-white px-5 py-3 rounded text-center">
                            <h1 class="text-2xl font-bold">Enter OTP</h1>
                            <div class="flex flex-col items-center mt-4">
                                <span v-if="timer">Enter the OTP you received at</span>
                                <span v-else>You can change your phone number</span>
                                <span v-if="timer" class="font-bold">{{ $page.props.user.phone }}</span>
                                <input v-else type="text" v-model="form.phone" class="input-box text-lg py-2 w-64 text-center">
                            </div>

                            <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
                                A new OTP code has been sent your phone number.
                            </div>

                            <div class="mb-4 font-medium text-sm text-red-600" v-if="verificationLinkExpired" >
                                The OTP code is either invalid or expired.
                            </div>

                            <div id="otp" class="flex flex-row justify-center text-center px-2 mt-5">
                                <template v-for="i in [1, 2, 3, 4, 5, 6]">
                                    <input :ref="`item_${i}`" @input.prevent="ev => handleInput(ev, i)" @keydown.delete="ev => handleDelete(ev, i)" class="m-1 border h-10 w-10 text-center form-control rounded" type="text" :id="`item-${i}`" maxlength="1" :autofocus="i === 1" />
                                </template>
                            </div>
                            <div class="flex justify-around items-center mt-5">
                                <div>
                                    <div v-if="timer">Resend OTP in {{ timer }} sec.</div>
                                    <a v-else @click.prevent="resend" class="flex items-center text-blue-700 text-sm hover:text-blue-900 cursor-pointer py-2 px-4 rounded-md border">
                                        <span class="font-bold">Resend OTP</span>
                                    </a>
                                </div>
                                <div class="flex">
                                    <a v-if="form.phone === $page.props.user.phone" @click.prevent="verify" class="flex items-center justify-center cursor-pointer px-3 py-2 mx-1 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition">Submit</a>
                                    <inertia-link :href="route(prefix + 'logout')" method="post" as="button" class="bg-gray-200 px-3 py-2 rounded border hover:bg-transparent text-sm text-gray-600 hover:text-gray-900">Log Out</inertia-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'

    export default {
        components: {
            AppLayout,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
        },

        props: {
            is_seller: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    id: this.$page.props.user.id,
                    phone: this.$page.props.user.phone,
                    code: '',
                }),
                timer: 10,
            }
        },

        methods: {
            verify() {
                this.$inertia.visit(route(this.prefix + 'verification.verify', {id: this.form.id, code: this.form.code}))
            },
            resend() {
                this.form.post(this.route(this.prefix + 'verification.send'), {
                    onFinish: () => this.timer = 10,
                });
            },
            handleInput(ev, i) {
                const value = ev.target.value;

                if (value && i < 6) {
                    i++;
                }

                this.handleCode();
                this.$refs[`item_${i}`].focus();
            },
            handleDelete(ev, i) {
                const value = ev.target.value;

                if (!value && i > 1) {
                    i--;
                }

                this.handleCode();
                this.$refs[`item_${i}`].focus();
            },
            handleCode() {
                this.form.code = Array.from(Array(6), (element, i) => {
                    return this.$refs[`item_${i + 1}`].value || '';
                }).join('');
            },
            countDown() {
                if(this.timer > 0) {
                    setTimeout(() => {
                        this.timer--;
                        this.countDown()
                    }, 1000)
                }
            }
        },

        computed: {
            verificationLinkSent() {
                return this.status === 'verification-code-sent';
            },
            verificationLinkExpired() {
                return this.status === 'verification-code-expired';
            },
            prefix() {
                return this.is_seller ? 'seller.' : '';
            }
        },

        created() {
            this.countDown();
            this.makeTitle('Phone Verify')
        }
    }
</script>
