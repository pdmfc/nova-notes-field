<template>
    <div class="flex row">
        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle"
                   class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
            <label for="toggle"
                   class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
        </div>
        <div @click="toggle" class="cursor-pointer">
            <svg v-if="isPrivate===false" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
            </svg>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return  {

            isPrivate:false,


        }

    },
    methods :{
        toggle(){
          this.isPrivate=!this.isPrivate
        }
    }

}
</script>
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
