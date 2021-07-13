<template>
    <!--    <panel-item :field="field" />-->
    <div>
        <h3 class="mb-4 text-lg font-semibold text-gray-900">Comments</h3>
        <notes :notes="notes" @reply-to="defineFormData($event)" @delete-note="openDeleteModal($event)"></notes>
        <note-form
            @note-submit="pushNotes($event)"
            @cancel-reply="defineFormData"
            :notable_id="notable_id"
            :notable_type="notable_type"
            :reply_to_id="reply_to_id"
            :reply_to_name="reply_to_name"
        ></note-form>
        <delete-resource-modal
            v-if="deleteModalOpen"
            @confirm="confirmDelete"
            @close="closeDeleteModal">
        </delete-resource-modal>
    </div>
</template>

<script>
import Notes from './Notes/Notes.vue';
import NoteForm from './Notes/NoteForm';

export default {
    components: {
        Notes,
        NoteForm,
    },
    props: ['resourceName', 'field'],
    data() {
        return {
            popperOptions: {
                placement: 'left',
                modifiers: {
                    offset: { offset: '0, 10px' },
                },
            },
            newNote: '',
            notes: [],
            notesCount: 0,
            notable_type: '',
            notable_id: '',
            reply_to_id: '',
            reply_to_name: '',
            deleteModalOpen: false,
            deleteId: null
        };
    },
    mounted() {
        this.notesCount = this.field.value;
        this.notable_id = this.field.notable_id;
        this.notable_type = this.field.notable_type;
        this.loadNotes();
    },
    methods: {
        loadNotes() {
            Nova.request()
                .get('/nova-vendor/notes-field/', {
                    params: {
                        notable_id: this.field.notable_id,
                        notable_type: this.field.notable_type,
                    },
                })
                .then(({ data }) => {
                    this.notes = data;
                    this.notesCount = this.notes.length;
                });
        },
        pushNotes(data) {
            if (data.notable_type === 'PDMFC\\NovaNotesField\\Models\\Note') {
                const parentNote = this.notes.find(note => note.id === data.notable_id)
                if (parentNote) {
                    parentNote.notes.push(data)
                }
            } else {
                this.notes.push(data)
            }

            this.notesCount = this.notes.length;
            this.notable_id = this.field.notable_id;
            this.notable_type = this.field.notable_type;
            this.reply_to = '';
        },
        defineFormData(data) {
            this.notable_id = data ? data.notable_id : this.field.notable_id;
            this.notable_type = data ? data.notable_type : this.field.notable_type;
            this.reply_to_id = data ? data.reply_to_id : '';
            this.reply_to_name = data ? data.reply_to_name : '';
        },
        confirmDelete() {
            Nova.request()
                .delete('/nova-vendor/notes-field/delete', {
                    params: {
                        id: this.deleteId
                    }
                })
                .then(() => {
                    this.notes.forEach((note, index) => {
                        if (note.id === this.deleteId) {
                            this.notes.splice(index, 1)
                        } else {
                            let childIndex = note.notes.findIndex(note => note.id === this.deleteId)
                            if (childIndex != -1) {
                                this.notes[index].notes.splice(childIndex, 1)
                            }
                        }
                    })
                    this.notesCount = this.notes.length
                    this.closeDeleteModal()
                });
        },
        openDeleteModal(deleteId) {
            this.deleteModalOpen = true
            this.deleteId = deleteId
        },
        closeDeleteModal() {
            this.deleteModalOpen = false
            this.deleteId = null
        }
    },
};
</script>

<style scoped src="../../sass/field.css"></style>
