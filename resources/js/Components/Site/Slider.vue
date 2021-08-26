<template>
    <div>
        <vueper-slides autoplay paralax :arrows="true">
            <vueper-slide
                v-for="(slide, i) in $page.props.slides.data"
                :key="i"
                :image="slide.image"
                :link="slide.link"
                openInNew />
        </vueper-slides>
        <!-- features -->
        <div class="pt-5">
            <div class="grid md:grid-cols-3 gap-3 lg:gap-6 mx-auto justify-center">
                <!-- single feature -->
                <div
                    class="border-primary border rounded-sm px-8 lg:px-3 lg:py-6 py-4 flex justify-center items-center gap-5">
                    <img src="/images/icons/delivery-van.svg" class="lg:w-12 w-10 h-12 object-contain">
                    <div>
                        <h4 class="font-medium capitalize text-lg">Delivery</h4>
                        <p class="text-gray-500 text-xs lg:text-sm">Very Fast Delivery</p>
                    </div>
                </div>
                <!-- single feature end -->
                <!-- single feature -->
                <div
                    class="border-primary border rounded-sm px-8 lg:px-3 lg:py-6 py-4 flex justify-center items-center gap-5">
                    <img src="/images/icons/money-back.svg" class="lg:w-12 w-10 h-12 object-contain">
                    <div>
                        <h4 class="font-medium capitalize text-lg">Refund</h4>
                        <p class="text-gray-500 text-xs lg:text-sm">7 Days Refund</p>
                    </div>
                </div>
                <!-- single feature end -->
                <!-- single feature -->
                <div
                    class="border-primary border rounded-sm px-8 lg:px-3 lg:py-6 py-4 flex justify-center items-center gap-5">
                    <img src="/images/icons/service-hours.svg" class="lg:w-12 w-10 h-12 object-contain">
                    <div>
                        <h4 class="font-medium capitalize text-lg">Support</h4>
                        <p class="text-gray-500 text-xs lg:text-sm">24/7 Customer Support</p>
                    </div>
                </div>
                <!-- single feature end -->
            </div>
        </div>
        <!-- features end -->
    </div>
</template>

<script>
import { VueperSlides, VueperSlide } from 'vueperslides'

export default {
    name: "Slider",
    components: {
        VueperSlides,
        VueperSlide,
    },
}
</script>

<style scoped>
@import '~vueperslides/dist/vueperslides.css';
</style>

<style>
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
</style>
