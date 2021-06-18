<template lang="html">
    <input
        @input="handleInput($event.target.value)"
        :value="value"
        @keyup.enter="$emit('enter')"
        type="text"
        :class="errorClass"
        class="py-2 px-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md border"
        placeholder="Write your thoughts..."
    />
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            default: '',
            required: true,
        },
        hasError: {
            type: Boolean
        }
    },
    methods: {
        handleInput(value) {
            this.$emit('input', value);
        },
    },
    computed: {
        errorClass() {
            return this.hasError ? 'border-red-500' : 'border-gray-300';
        }
    }
};
</script>

<style scoped src="../../../sass/field.css"></style>
