<template>
    <div>
        <vueper-slides autoplay paralax :arrows="false">
            <vueper-slide
                v-for="(slide, i) in slides"
                :key="i"
                :image="slide.image"
                :title="slide.title"
                :content="slide.content" />
        </vueper-slides>
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
    data() {
        return {
            slides: [
                {
                    title: 'El Teide Volcano, Spain',
                    content: 'Photo by Max Rive',
                    // You can also provide a URL for the image.
                    image: 'https://antoniandre.github.io/vueper-slides/images/crater-lake-oregon-usa.jpg'
                },
                {
                    title: 'El Teide Volcano, Spain',
                    content: 'Photo by Max Rive',
                    // You can also provide a URL for the image.
                    image: 'https://antoniandre.github.io/vueper-slides/images/el-teide-volcano-spain.jpg'
                },
                {
                    title: 'El Teide Volcano, Spain',
                    content: 'Photo by Max Rive',
                    // You can also provide a URL for the image.
                    image: 'https://antoniandre.github.io/vueper-slides/images/chernobyl-ukraine.jpg'
                },
            ]
        }
    },
}
</script>

<style scoped>
@import '~vueperslides/dist/vueperslides.css';
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
