<template lang="html">
  <label :class="[isActive ? 'btn-primary' : 'bg-gray-500', 'w-16 h-8 relative cursor-pointer flex rounded-full transition duration-300']">
    <input type="checkbox" :value="isActive" @change="handleChange" class="relative invisible w-0 h-0"/>
    <span :class="[{'transform translate-x-8': isActive}, 'flex self-center items-center justify-center rounded-full bg-white w-6 h-6 transition duration-300 text-black']">
      <slot v-if="!isActive" name="iconOff"></slot>
      <slot v-else name="iconOn"></slot>
    </span>
  </label>
</template>

<script>
export default {
    model: {
        prop: 'isActive',
        event: 'change'
    },
    props: {
        isActive: {
            type: Boolean,
            required: true
        }
    },
    methods: {
        handleChange() {
            this.$emit('change', !this.isActive)
        }
    }
}
</script>

<style scoped src="../../../sass/field.css"></style>
