<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                API Tokens
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <api-token-manager :tokens="tokens"
                                   :available-permissions="availablePermissions"
                                   :default-permissions="defaultPermissions" />
            </div>
        </div>
    </seller-layout>
</template>

<script>
    import ApiTokenManager from './ApiTokenManager'
    import SellerLayout from '@/Layouts/SellerLayout'

    export default {
        props: [
            'tokens',
            'availablePermissions',
            'defaultPermissions',
        ],

        components: {
            ApiTokenManager,
            SellerLayout,
        },
    }
</script>
