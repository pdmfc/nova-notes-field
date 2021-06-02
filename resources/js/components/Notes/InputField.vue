<template lang="html">
    <div class="flex flex-col">
        <div class="flex flex-col space-y-2 " v-if="errors.length > 0">
            <p class="text-red-500" v-for="error in errors">{{ error }}</p>
        </div>
        <div class="mt-1 flex flex-wrap flex-row space-x-4">
            <input
                @input="handleInput($event.target.value)"
                @keyup.enter="emitMessage"
                :value="value"
                type="text"
                :class="errorClass"
                class="py-2 px-3 flex-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md border"
                placeholder="Write your thoughts..."
            />
            <button
                @click="handleInsertMessage"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Send
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            default: '',
            required: true,
        },
        errors: {
            type: Array
        }
    },
    methods: {
        handleInput(event) {
            this.$emit('input', event);
        },
        handleInsertMessage() {
            this.$emit('insert-message');
        },
    },
    computed: {
        errorClass() {
            return this.errors.length === 0 ? 'border-gray-300' : 'border-red-500';
        }
    }
};
</script>

<style lang="css" scoped src="../../../assets/tailwind.css"></style>
