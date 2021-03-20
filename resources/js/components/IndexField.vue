<template>
    <popper
        trigger="clickToOpen"
        :options="{
      placement: 'top',
      modifiers: { offset: { offset: '0,10px' } }
    }">
        <div class="popper">
            <div style="width: 400px; height: 300px; background: #3c4655;'">Opa</div>
        </div>
        <a href="#"
           slot="reference"
           class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltip no-underline relative"
           data-testid="users-items-0-view-button" dusk="1-view-button" data-original-title="null">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-current">
                <path
                    d="M2 15V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v15a1 1 0 0 1-1.7.7L16.58 17H4a2 2 0 0 1-2-2zM20 5H4v10h13a1 1 0 0 1 .7.3l2.3 2.29V5z"/>
            </svg>
            <div class="absolute px-2 py-1 rounded-full text-white text-xs bg-primary font-bold pin-t pin-l ml-4 -mt-3">
                {{ field.value }}
            </div>
        </a>
    </popper>
</template>

<script>
import Popper from 'vue-popperjs'
import 'vue-popperjs/dist/vue-popper.css'

export default {
    components: {
        Popper
    },
    props: ['resourceName', 'field']
}
</script>
