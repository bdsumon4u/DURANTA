<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sellership
            </h2>
        </template>

        <sellership-manager :application="application.data" />
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import SellershipManager from "@/Components/SellershipManager";

export default {
    name: "Sellership",
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
        AdminLayout,
        SellershipManager,
    },
}
</script>
