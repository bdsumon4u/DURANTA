<template>
    <div class="group flex flex-col rounded bg-white shadow overflow-hidden">
        <inertia-link :href="route('products.show', {slug: product.slug, ...(campaign ? {campaign: campaign.slug} : {})})">
            <!-- product image -->
            <div class="relative">
                <img :src="product.first_media" class="w-full">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"></div>
            </div>
            <!-- product image end -->
            <!-- product content -->
            <div class="flex-1 pt-4 pb-3 px-4">
                <h4 class="font-medium text-sm font-roboto line-clamp-2 mb-2 text-gray-800 hover:text-primary transition">
                    {{ product.name }}
                </h4>
                <div class="flex items-baseline mb-1 space-x-2">
                    <p class="text-xl text-primary font-roboto font-semibold">{{ moneyFormat(!!campaign ? product.pivot.selling : (product.price - product.discount)) }}</p>
                    <p class="text-sm text-gray-400 font-roboto line-through">{{ moneyFormat(product.price) }}</p>
                </div>
            </div>
            <!-- product content end -->
        </inertia-link>
        <!-- product button -->
        <a href="#"
           @click.prevent="addToCart(product)"
           class="flex items-center justify-center py-1 mx-1 mb-1 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path fill="none" d="M0 0h24v24H0z"/>
                <path fill="currentColor" d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
            </svg>
            <span class="font-semibold ml-1">Add To Cart</span>
        </a>
        <!-- product button end -->
    </div>
</template>

<script>
export default {
    name: "Product",
    props: ['campaign', 'product'],
}
</script>
