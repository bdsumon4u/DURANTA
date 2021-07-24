<template>
    <component :is="component" :tokens="tokens" :available-permissions="availablePermissions" :default-permissions="defaultPermissions" />
</template>

<script>
import AdminAPI from '@/Pages/Admin/API/Show'
import SellerAPI from '@/Pages/Seller/API/Show'
import UserAPI from '@/Pages/API/Show'

export default {
    props: [
        'tokens',
        'availablePermissions',
        'defaultPermissions',
    ],

    components: {
        AdminAPI,
        SellerAPI,
        UserAPI,
    },

    computed: {
        component() {
            if (this.is_admin) {
                return 'AdminAPI';
            }
            if (this.is_seller) {
                return 'SellerAPI';
            }
            return 'UserAPI';
        }
    },

    data() {
        return {
            is_admin: this.$page.props.is_admin,
            is_seller: this.$page.props.is_seller,
        };
    }
}
</script>
