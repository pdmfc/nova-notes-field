<template lang="html">
    <input
        @input="handleInput($event.target.value)"
        :value="value"
        @keyup.enter="$emit('enter')"
        type="text"
        :class="[errorClass, 'py-2 px-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md border']"
        :placeholder="placeholder"
        ref="inputField"
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
        placeholder: {
            type: String,
            default() {
                return 'Write your thoughts...'
            }
        },
        hasError: {
            type: Boolean
        },
        focused: {
            type: Boolean
        }
    },
    methods: {
        handleInput(value) {
            this.$emit('input', value);
        },
    },
    watch: {
        focused() {
            if (this.focused) {
                this.$refs.inputField.focus()
            }
        }
    },
    computed: {
        errorClass() {
            return this.hasError ? 'border-red-500' : 'border-gray-300';
        }
    }
};
</script>

<style scoped src="../../../sass/field.css"></style>
