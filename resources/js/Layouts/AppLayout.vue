<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <primary-navigation />
                <responsive-navigation />
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    //import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    //import JetDropdown from '@/Jetstream/Dropdown.vue'
    //import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    //import JetNavLink from '@/Jetstream/NavLink.vue'
    //import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import PrimaryNavigation from '../Shared/Navigation/PrimaryNavigation.vue'
    import ResponsiveNavigation from '../Shared/Navigation/ResponsiveNavigation.vue'

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            //JetApplicationMark,
            JetBanner,
            //JetDropdown,
            //JetDropdownLink,
            //JetNavLink,
            //JetResponsiveNavLink,
            //Link,
            PrimaryNavigation,
            ResponsiveNavigation
        },
    })
</script>
