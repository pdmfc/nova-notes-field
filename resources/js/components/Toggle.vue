<template>
    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
        <input type="checkbox" name="toggle" id="toggle"
               class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
        <label for="toggle"
               class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
    </div>
</template>

<style>
/* CHECKBOX TOGGLE SWITCH */
/* @apply rules for documentation, these do not work as inline style */
.toggle-checkbox {
    border-color: #e2e8f0;
}

.toggle-checkbox:checked {
    @apply: right-0 border-green-400;
    right: 0;
    border-color: #68D391;
}

.toggle-checkbox:checked + .toggle-label {
    @apply: bg-green-400;
    background-color: #68D391;
}

.w-10 {
    width: 2.5rem;
}

.w-6 {
    width: 1.5rem;
}

.duration-200 {
    transition-duration: .2s;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}

.ease-in {
    transition-timing-function: cubic-bezier(.4, 0, 1, 1);
}

.transition {
    transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
}
</style>

<script>
export default {}
</script>
