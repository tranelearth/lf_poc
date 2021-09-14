<template>
  <div v-if="links.length > 3">
    <div class="">
      <template v-for="(link, key) in links">
        <!-- <div v-if="link.url === null" :key="key" class="" v-html="link.label" />
        <inertia-link v-else :key="key" class="button" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
        -->
      </template>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
  },
}
</script>
