<template>
    <div class="wrapper tabular">
        <!-- <search-filter v-model="form.search" @reset="reset">
            <label>Trashed:</label>
            <select v-model="form.trashed">
                <option :value="null" />
                <option value="with">With Trashed</option>
                <option value="only">Only Trashed</option>
            </select>
        </search-filter> -->
        <table v-if="broker.carriers.length > 0">
            <thead>
                <tr>
                    <th>Carrier Code</th>
                    <th>Carrier Name</th>
                    <th>DOT #</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(carrier, index) in broker.carriers" :key="index">
                    <td>{{ carrier.carrierCode }}</td>
                    <td>{{ carrier.carrierName }}</td>
                    <td>{{ carrier.dotNumber }}</td>
                    <td class="actions">
                        <a :href="'#show' + carrier.id" @click.prevent="openModal(carrier)" class="button show">Show</a>
                        <!--<inertia-link v-if="$hasPermission('broker.carriers.edit')" class="button edit" :href="route('broker.carriers.edit', carrier.pivot)">Edit</inertia-link>
                        <a v-if="$hasPermission('broker.carriers.destroy')" @click.prevent="deleteCarrier(carrier)" class="button delete" href="#">Delete</a>
                        <a v-if="canDeactivate(carrier)" @click.prevent="deactivateCarrier(carrier)" class="button delete" href="#">Deactivate</a>
                        <a v-if="canRestore(carrier)" @click.prevent="restoreCarrier(carrier)" class="button restore" href="#">Restore</a>-->
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div v-if="broker.carriers.length === 0">No carriers found.</div>

        <!--<pagination class="mt-6" :links="broker.carriers.links" /> -->

        <jet-modal v-if="modalCarrier.id" :show="showCarrierInfoModal" id="carrier-info-modal" @close="closeModal()">
            <carrier-info :carrier="modalCarrier" @closeModal="closeModal()" />
        </jet-modal>
    </div>
</template>
<script>

import { defineComponent } from 'vue'
import CarrierInfo from '@/Pages/Broker/MyCarriers/CarrierInfo'
import JetModal from '@/Jetstream/Modal'
import SearchFilter from '@/Shared/SearchFilter'
import debounce from "lodash/debounce"
import Pagination from '@/Shared/Pagination'
export default defineComponent({
    components: {
        CarrierInfo,
        JetModal,
        SearchFilter,
        Pagination,
    },
    props: {
        broker: {
            type: [Object, null],
            required: false,
        }, 
        filters: {
            type: Object,
            required: false,
            default: function () { return {search: null, trashed: null}},
        }, 
        errors: {
            type: Object,
            required: false,
        }
    },
    data() {
        return {
            isLoading: false,
            modalCarrier: {},
            showCarrierInfoModal: false,
            form: {
                search: this.filters.search,
                trashed: this.filters.trashed,
            },
        }
    },
    watch: {
        form: {
            handler: debounce(function() {
                let query = Object.assign({}, this.form)
                this.$inertia.get(this.route('broker.carriers.index', Object.keys(query).length ? query : { remember: 'forget' }))
            }, 500),
            deep: true,
        },
    },
    methods: {
        deleteCarrier: function (carrier) {
            if (!confirm('Are you sure want to permanently delete?')) return;
            this.$inertia.delete(this.route('broker.carriers.destroy', carrier.id), {
                onStart: () => this.isLoading = true,
                onFinish: () => this.isLoading = false,
            });
        },
        canDeactivate: function (carrier) {
            return this.$hasPermission('broker.carriers.deactivate') && carrier.deleted_at === null;
        },
        deactivateCarrier: function (carrier) {
            this.$inertia.delete(this.route('broker.carriers.deactivate', carrier.id), {
                onStart: () => this.isLoading = true,
                onFinish: () => this.isLoading = false,
            });
        },
        canRestore: function (carrier) {
            return this.$hasPermission('broker.carriers.restore') && carrier.deleted_at !== null;
        },
        restoreCarrier: function (carrier) {
            this.$inertia.get(this.route('broker.carriers.restore', carrier.id), {
                onStart: () => this.isLoading = true,
                onFinish: () => this.isLoading = false,
            });
        },
        openModal: function (carrier) {
            this.modalCarrier = carrier;
            this.showCarrierInfoModal = true;
        },
        closeModal: function () {
            this.showCarrierInfoModal = false;
        },
        reset() {
            this.form = Object.fromEntries(
                Object.entries(this.form).map(([key, value]) => [key, ''])
            );
        },
    }
});
</script>