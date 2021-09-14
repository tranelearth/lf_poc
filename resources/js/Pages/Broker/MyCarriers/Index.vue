<template>
    <Head title="My Carriers" />
    <app-layout>
        <div slot="header">
            <!--<inertia-link v-if="$hasPermission('carriers.create')" :href="route('carriers.create')" class="button">
                <span>Add</span> <span class="hidden md:inline">Carrier Info to User</span>
            </inertia-link>-->
            <h1>Carriers</h1>
        </div>
        <div class="wrapper list">
            <carrier-list :broker="broker" :filters="filters" :errors="errors" />
        </div>
    </app-layout>
</template>
<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout'
import CarrierList from '@/Pages/Broker/MyCarriers/CarrierList'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Head,
        Link,
        AppLayout,
        CarrierList,
    },
    props: {
        broker: {
            type: [Object, null],
            required: false,
        },
        filters: {
            type: Object,
            required: false,
        }, 
        errors: {
            type: Object,
            required: false,
        }
    },
    data() {
        return {
            isLoading: false,
        }
    },
});
</script>