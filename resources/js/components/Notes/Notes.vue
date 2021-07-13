<template>
        <div class="flex flex-grow">
            <div v-if="notes.length === 0" class="self-center text-center block w-full">
                <h2 class="text-xl p-52 font-semibold opacity-50">No notes found...</h2>
            </div>
            <ul class="space-y-4 flex-grow">
                <note v-for="note in notes" :data="note" :key="note.note" @reply-to="handleReplyTo($event)" @delete-note="handleDeleteNote($event)"></note>
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
        handleReplyTo(data) {
            this.$emit('reply-to', data)
        },
        handleDeleteNote(id) {
            this.$emit('delete-note', id)
        }
    }
}
</script>

<style scoped src="../../../sass/field.css"></style>
