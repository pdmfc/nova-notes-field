<template>
        <div class="flex flex-grow">
            <div v-if="notes.length === 0" class="self-center block w-full">
                <h2 class="text-xl font-semibold opacity-50">No notes found...</h2>
            </div>
            <ul class="space-y-4 flex-grow">
                <note v-for="note in notes" :data="note" :key="note.note"></note>
            </ul>
        </div>
</template>


<script>
import Note from './Note.vue'

export default {
    components: {
        Note
    },
    props: {
        notes: {
            type: Array,
            required: true
        },
    },
    methods: {
    }
}
</script>
<style scoped src="../../../sass/tailwind.css">>

</style>
