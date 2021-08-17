<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div v-if="application?.data?.status !== 'APPROVED'" class="py-6">
            <sellership-manager :application="application.data" />
        </div>
    </seller-layout>
</template>

<script>
    import SellerLayout from '@/Layouts/SellerLayout'
    import SellershipManager from '@/Components/SellershipManager'

    export default {
        props: {
            application: {
                type: Object,
                default: {
                    store_name: '',
                    store_email: '',
                    store_phone: '',
                    store_address: '',
                    nid_front: '',
                    nid_back: '',
                    license: '',
                    signboard: '',
                }
            }
        },
        components: {
            SellerLayout,
            SellershipManager,
        },
    }
</script>
