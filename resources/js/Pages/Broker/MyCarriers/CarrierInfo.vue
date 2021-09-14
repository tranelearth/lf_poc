<template>
    <div class="info modal wrapper">
        <h1>Carrier Info</h1>
        <div v-if="carrier" class="main">
            <div>{{carrier.carrierName}}</div>
            <div>{{carrier.carrierCode}}</div>
            <div v-if="carrier.pivot && carrier.pivot.note">
                <label>Notes</label>
                <div>{{carrier.pivot.note}}</div>
            </div>
        </div>

        <button @click="$emit('closeModal')" type="button" class="button">Close</button>
    </div>
</template>

<script>
export default {
    components: {
    },
    props: {
        carrier: {
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
}
</script>