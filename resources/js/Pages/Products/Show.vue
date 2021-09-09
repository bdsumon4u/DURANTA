<template>
    <app-layout>
        <!-- breadcrumb -->
        <breadcrumb :items="[{title: 'Products', link: route('products')}, {title: 'Italian L Shape Sofa'}]" />
        <!-- breadcrumb end -->

        <!-- product view -->
        <div class="container pt-4 pb-6 grid lg:grid-cols-2 gap-6">
            <!-- product image -->
            <div>
                <div>
                    <vueper-slides
                        ref="productImageLarge"
                        :touchable="false"
                        fade
                        :autoplay="false"
                        :bullets="false"
                        @slide="$refs.productImageSmall.goToSlide($event.currentSlide.index, { emit: false })"
                        fixed-height="400px">
                        <vueper-slide
                            v-for="(media, i) in product.data.media"
                            :key="i"
                            :image="media.link">
                        </vueper-slide>
                    </vueper-slides>
                </div>
                <vueper-slides
                    class="mt-3 product-image-small"
                    ref="productImageSmall"
                    @slide="$refs.productImageLarge.goToSlide($event.currentSlide.index, { emit: false })"
                    :visible-slides="product.data.media.length"
                    fixed-height="75px"
                    :bullets="false"
                    :touchable="false"
                    :gap="0.25"
                    :arrows="false">
                    <vueper-slide
                        v-for="(media, i) in product.data.media"
                        :key="i"
                        :image="media.link"
                        @click.native="$refs.productImageSmall.goToSlide(i)">
                    </vueper-slide>
                </vueper-slides>
            </div>
            <!-- product image end -->
            <!-- product content -->
            <div>
                <h2 class="md:text-3xl text-2xl font-medium uppercase mb-2">{{ product.data.name }}</h2>
                <div class="space-y-2">
                    <p class="text-gray-800 font-semibold space-x-2">
                        <span>Availability: </span>
                        <span class="text-green-600">{{ product.data.stock_track ? product.data.stock_count : '' }} In Stock</span>
                    </p>
                    <p v-if="product.data.brand" class="space-x-2">
                        <span class="text-gray-800 font-semibold">Brand: </span>
                        <inertia-link class="text-gray-100 text-sm bg-primary px-2 py-1 rounded-md whitespace-nowrap" :href="route('brands.show', product.data.brand_slug)">{{ product.data.brand_name }}</inertia-link>
                    </p>
                    <p class="space-x-1">
                        <span class="text-gray-800 font-semibold">Categories: </span>
                        <span class="flex flex-wrap gap-1">
                            <inertia-link v-for="category in product.data.categories" class="text-gray-100 text-sm bg-primary px-2 py-1 rounded-md whitespace-nowrap" href="">{{ category.name }}</inertia-link>
                        </span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">SKU: </span>
                        <span class="text-gray-600 uppercase">{{ product.data.sku }}</span>
                    </p>
                </div>
                <div class="mt-4 flex items-baseline gap-3">
                    <span class="text-primary font-semibold text-xl">{{ moneyFormat(campaign.data.id ? product.data.pivot.selling : (product.data.price - product.data.discount))}}</span>
                    <span class="text-gray-500 text-base line-through">{{ moneyFormat(product.data.price) }}</span>
                </div>
                <!-- size -->
<!--                <div class="mt-4">-->
<!--                    <h3 class="text-base text-gray-800 mb-1">Size</h3>-->
<!--                    <div class="flex items-center gap-2">-->
<!--                        &lt;!&ndash; single size &ndash;&gt;-->
<!--                        <div class="size-selector">-->
<!--                            <input type="radio" name="size" class="hidden" id="size-xs">-->
<!--                            <label for="size-xs" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">-->
<!--                                XS-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; single size end &ndash;&gt;-->
<!--                        &lt;!&ndash; single size &ndash;&gt;-->
<!--                        <div class="size-selector">-->
<!--                            <input type="radio" name="size" class="hidden" id="size-s">-->
<!--                            <label for="size-s" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">-->
<!--                                S-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; single size end &ndash;&gt;-->
<!--                        &lt;!&ndash; single size &ndash;&gt;-->
<!--                        <div class="size-selector">-->
<!--                            <input type="radio" name="size" class="hidden" id="size-m" checked>-->
<!--                            <label for="size-m" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">-->
<!--                                M-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; single size end &ndash;&gt;-->
<!--                        &lt;!&ndash; single size &ndash;&gt;-->
<!--                        <div class="size-selector">-->
<!--                            <input type="radio" name="size" class="hidden" id="size-l">-->
<!--                            <label for="size-l" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">-->
<!--                                L-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; single size end &ndash;&gt;-->
<!--                        &lt;!&ndash; single size &ndash;&gt;-->
<!--                        <div class="size-selector">-->
<!--                            <input type="radio" name="size" class="hidden" id="size-xl">-->
<!--                            <label for="size-xl" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">-->
<!--                                XL-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; single size end &ndash;&gt;-->
<!--                    </div>-->
<!--                </div>-->
                <!-- size end -->
                <!-- color -->
<!--                <div class="mt-4">-->
<!--                    <h3 class="text-base text-gray-800 mb-1">Color</h3>-->
<!--                    <div class="flex items-center gap-2">-->
<!--                        &lt;!&ndash; single color &ndash;&gt;-->
<!--                        <div class="color-selector">-->
<!--                            <input type="radio" name="color" class="hidden" id="color-red" checked>-->
<!--                            <label for="color-red" style="background-color : #fc3d57" class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; single color end &ndash;&gt;-->
<!--                        &lt;!&ndash; single color &ndash;&gt;-->
<!--                        <div class="color-selector">-->
<!--                            <input type="radio" name="color" class="hidden" id="color-white">-->
<!--                            <label for="color-white" style="background-color : #fff" class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; single color end &ndash;&gt;-->
<!--                        &lt;!&ndash; single color &ndash;&gt;-->
<!--                        <div class="color-selector">-->
<!--                            <input type="radio" name="color" class="hidden" id="color-black">-->
<!--                            <label for="color-black" style="background-color : #000" class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; single color end &ndash;&gt;-->
<!--                    </div>-->
<!--                </div>-->
                <!-- color end -->
                <!-- quantity -->
                <div class="mt-4">
                    <h3 class="text-base text-gray-800 mb-1">Quantity</h3>
                    <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                        <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none" @click.prevent="decrement">-</div>
                        <div class="h-8 w-10 flex items-center justify-center">{{ quantity }}</div>
                        <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none" @click.prevent="increment">+</div>
                    </div>
                </div>
                <!-- color end -->
                <!-- add to cart button -->
                <div class="flex gap-3 border-b border-gray-200 pb-5 mt-6">
                    <a href="#" @click.prevent="addToCart(product.data, quantity)" class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase hover:bg-transparent hover:text-primary transition text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path fill="currentColor" d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                        </svg>
                        <span class="font-semibold ml-1">Add To Cart</span>
                    </a>
                </div>
                <!-- add to cart button end -->
            </div>
            <!-- product content end -->
        </div>
        <!-- product view end -->

        <!-- product details and review -->
        <div class="container pb-16">
            <!-- detail buttons -->
            <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">
                Product Details
            </h3>
            <!-- details button end -->

            <!-- details content -->
            <div class="lg:w-4/5 xl:w-3/5 pt-6">
                <div class="space-y-3 text-gray-600 product-description" v-html="product.data.description"></div>
            </div>
            <!-- details content end -->
        </div>
        <!-- product details and review end -->

        <!-- related products -->
        <div class="container pb-16">
            <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-6">Related Products</h2>
            <!-- product wrapper -->
            <div class="grid lg:grid-cols-6 sm:grid-cols-3 grid-cols-2 lg:gap-6 md:gap-4 gap-2">
                <!-- single product -->
                <template v-for="related in product.data.seller.products">
                    <product :product="related" />
                </template>
                <!-- single product end -->
            </div>
            <!-- product wrapper end -->
        </div>
        <!-- related products end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Product from "@/Components/Site/Product";
import Breadcrumb from "@/Components/Site/Breadcrumb";
import { VueperSlides, VueperSlide } from 'vueperslides'

export default {
    name: "Show",
    props: ['campaign', 'product'],
    components: {
        AppLayout,
        Breadcrumb,
        Product,
        VueperSlides,
        VueperSlide,
    },
    methods: {
        increment() {
            if (this.product.data.stock_track) {
                if (this.product.data.stock_count > this.quantity) {
                    this.quantity++;
                }
            } else {
                this.quantity++;
            }
        },
        decrement() {
            if (this.quantity > 1) {
                this.quantity--;
            }
        },
    },
    data() {
        return {
            quantity: 1,
        }
    }
}
</script>

<style scoped>
@import '~vueperslides/dist/vueperslides.css';
</style>

<style>
    .product-image-small .vueperslide {
        box-sizing: border-box;
        border: 1px solid #fff;
        transition: 0.3s ease-in-out;
        opacity: 0.7;
        cursor: pointer;
        max-width: 8rem;
    }
    .product-image-small .vueperslides__track-inner {
        justify-content: space-between;
    }
    .product-image-small .vueperslide--active {
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
        opacity: 1;
        border-color: crimson;
    }
    .vueperslides__bullet {
        margin: 1.5em .25em !important;
    }
    .vueperslides__bullet .default {
        width: 18px !important;
        height: 6px !important;
        border-radius: 0 !important;
    }
    .vueperslides__bullet--active .default {
        width: 30px !important;
        border-width: 2px !important;
    }
    .product-description figure.table {
        margin: 1rem auto;
    }
    .product-description table th,
    .product-description table td {
        border: 1px solid #dedede;
        padding: .25rem .5rem;
    }
</style>
