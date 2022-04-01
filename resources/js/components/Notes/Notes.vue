<template>
        <div class="flex flex-grow">
            <div v-if="notes.length === 0" class="self-center text-center block w-full">
                <h2 class="text-xl font-semibold opacity-50">No notes found...</h2>
            </div>
            <ul class="space-y-4 flex-grow">
                <note 
                v-for="note in notes" 
                :data="note" 
                :key="note.note" 
                @reply-to="handleReplyTo($event)"
                @reply-delete="handleNoteDelete($event)"
                @reply-edit="handleEdit($event)"
                >
                </note>
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
        handleNoteDelete(data){
            this.$emit("note-delete", data);
        },
        handleEdit(data){
            this.$emit("note-edit", data);
        }, 
             
    },
};
</script>

<style scoped src="../../../sass/field.css"></style>
