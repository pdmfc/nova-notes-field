<template>
    <!--    <panel-item :field="field" />-->
    <div>
        <h3 class="mb-4 text-lg font-semibold text-gray-900">Comments</h3>
        <notes :notes="notes"></notes>
        <input-field v-model="newNote" @insert-message="onSubmit"></input-field>
    </div>
</template>

<script>
import Notes from './Notes/Notes.vue';
import InputField from './Notes/InputField.vue';

export default {
    components: {
        Notes,
        InputField,
    },
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    data() {
        return {
            newNote: '',
            notes: [],
            notesCount: 0,
        };
    },
    mounted() {
        this.loadNotes();
    },
    methods: {
        onSubmit() {
            Nova.request()
                .post('/nova-vendor/notes-field/new', {
                    note: this.newNote,
                    notable_id: this.field.notable_id,
                    notable_type: this.field.notable_type,
                })
                .then(({ data }) => {
                    this.notes.push(data);
                    this.notesCount = this.notes.length;
                    this.newNote = '';
                });
        },
        loadNotes() {
            if (this.loaded) {
                return;
            }
            Nova.request()
                .get(
                    `/nova-vendor/notes-field?notable_id=${this.field.notable_id}&notable_type=${this.field.notable_type}`
                )
                .then(({ data }) => {
                    this.notes = data;
                    this.notesCount = this.notes.length;
                    this.loaded = true;
                });
        },
    },
};
</script>

<style scoped src="../../sass/tailwind.css"></style>
