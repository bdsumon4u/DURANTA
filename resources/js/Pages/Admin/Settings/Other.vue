<template>
    <layout :tabs="tabs" active="other">
        Content
    </layout>
</template>

<script>
import Layout from "./Layout";

export default {
    name: "Other",

    props: ['tabs'],

    components: {
        Layout
    },
}
</script>
