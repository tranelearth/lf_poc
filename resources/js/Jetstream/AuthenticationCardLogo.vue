<template>
    <Link :href="'/'">
        <img src="/i/liquidfreight_logo.png" alt="Liquid Freight Logo">
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
