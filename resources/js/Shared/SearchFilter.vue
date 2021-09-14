<template>
  <div class="">
    <div class="">
      <dropdown :auto-close="false" class="" placement="bottom-start">
        <div class="flex items-baseline">
          <span class="hidden md:inline">Filter</span>
          <svg class="w-2 h-2 fill-gray-700 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
            <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
          </svg>
        </div>
        <div slot="dropdown" class="mt-2 px-4 py-6 w-screen shadow-xl bg-white rounded" :style="{ maxWidth: `${maxWidth}px` }">
          <slot />
        </div>
      </dropdown>
      <input class="focus:ring" autocomplete="off" type="text" name="search" placeholder="Search…" :value="value" @input="$emit('input', $event.target.value)" />
    </div>
    <button class="button" type="button" @click="$emit('reset')">Reset</button>
  </div>
</template>

<script>
import Dropdown from '@/Shared/Forms/Dropdown'
export default {
  components: {
    Dropdown,
  },
  props: {
    value: String,
    maxWidth: {
      type: Number,
      default: 300,
    },
  },
}
</script>