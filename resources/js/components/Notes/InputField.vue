<template lang="html">
    <div class="flex flex-col">
        <toggle></toggle>
        <div class="flex flex-col space-y-2 " v-if="errors.length > 0">
            <p class="text-red-500" v-for="error in errors">{{ error }}</p>
        </div>
        <div class="mt-1 flex flex-wrap flex-row space-x-4">
            <input
                @input="handleInput($event.target.value)"
                @keyup.enter="handleInsertMessage"
                :value="value"
                type="text"
                :class="errorClass"
                class="py-2 px-3 flex-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md border"
                placeholder="Write your thoughts..."
            />
            <div class="flex-no-shrink ml-auto">
                <a class=" btn btn-default btn-primary text-white cursor-pointer" @click="handleInsertMessage">Send</a>

            </div>
        </div>
    </div>
</template>

<script>
import Toggle from '../Toggle.vue';

export default {
    components: { Toggle },
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

<style scoped src="../../../sass/field.css"></style>
