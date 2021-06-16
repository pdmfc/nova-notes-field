<template lang="html">
    <div class="flex flex-col">
        <toggle v-model="isPrivate" icon="olho"></toggle>
        <toggle v-model="richText" icon="texto"></toggle>
    </div>
</template>

<script>
import Toggle from '../Toggle.vue';
import InputField from './InputField'

export default {
    components: { Toggle },
    props: {
    },
    data () {
        return {
            message: '',
            isPrivate: false,
            richText: true
        }
    },
    watch: {
        isPrivate (nv, ov) {
            console.log('isPrivate', nv, ov)
        },
        richText (nv, ov) {
            console.log('richText', nv, ov)
        }
    },
    computed: {},
    methods: {
    }
}
</script>
