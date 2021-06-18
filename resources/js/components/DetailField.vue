<template>
    <!--    <panel-item :field="field" />-->
    <div>
        <h3 class="mb-4 text-lg font-semibold text-gray-900">Comments</h3>
        <notes :notes="notes"></notes>
        <note-form
            @note-submit="pushNotes($event)"
            :field="field"
        ></note-form>
    </div>
</template>

<script>
import Notes from './Notes/Notes.vue';
import NoteForm from './Notes/NoteForm.vue';

export default {
    components: {
        Notes,
        NoteForm
    },
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    data() {
        return {
            newNote: '',
            notes: [],
            notesCount: 0
        };
    },
    mounted() {
        this.loadNotes();
    },
    methods: {
        loadNotes() {
            Nova.request()
                .get( '/nova-vendor/notes-field/', {
                    params: {
                        notable_id: this.field.notable_id,
                        notable_type: this.field.notable_type
                    }
                })
                .then(({data}) => {
                    this.notes = data;
                    this.notesCount = this.notes.length;
                    this.errors = [];
                });
        },
        pushNotes(data) {
            this.notes.push(data)
            this.notesCount = this.notes.length
        }
    },
};
</script>

<style scoped src="../../sass/field.css"></style>
