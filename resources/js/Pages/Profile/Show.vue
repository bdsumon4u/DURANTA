<template>
    <component :is="component" :sessions="sessions" />
</template>

<script>
import AdminProfile from '@/Pages/Admin/Profile/Index'
import SellerProfile from '@/Pages/Seller/Profile/Index'
import UserProfile from '@/Pages/Profile/Index'

export default {
    props: ['sessions'],

    components: {
        AdminProfile,
        SellerProfile,
        UserProfile,
    },

    computed: {
        component() {
            if (this.is_admin) {
                return 'AdminProfile';
            }
            if (this.is_seller) {
                return 'SellerProfile';
            }
            return 'UserProfile';
        }
    },

    data() {
        return {
            is_admin: this.$page.props.is_admin,
            is_seller: this.$page.props.is_seller,
        };
    },
}
</script>
