<template>
    <popper
        trigger="clickToToggle"
        append-to-body
        boundaries-selector="body"
        :options="popperOptions"
    >
        <div class="flex">
            <div
                class="bg-white flex-1 flex flex-col rounded-lg overflow-hidden divide-y divide-gray-200"
            >
                <div
                    class="overflow-y-auto flex-grow flex px-4 py-5"
                    style="width: 400px; height: 400px; max-height: 400px; max-width:400px;"
                >
                    <notes :notes="notes"></notes>
                </div>
                <div class="bg-gray-50 p-4">
                    <note-form
                        @note-submit="pushNotes($event)"
                        :notable_id="field.notable_id"
                        :notable_type="field.notable_type"
                    ></note-form>
                </div>
            </div>
        </div>
        <div
            slot="reference"
            class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltip no-underline relative"
            @click="loadNotes"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
                class="fill-current"
            >
                <path
                    d="M2 15V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v15a1 1 0 0 1-1.7.7L16.58 17H4a2 2 0 0 1-2-2zM20 5H4v10h13a1 1 0 0 1 .7.3l2.3 2.29V5z"
                />
            </svg>
            <div
                class="absolute px-2 py-1 rounded-full text-white text-xs bg-primary font-bold pin-t pin-l ml-4 -mt-3"
            >
                {{ notesCount }}
            </div>
        </div>
    </popper>
</template>

<script>
import Popper from 'vue-popperjs';
import Notes from './Notes/Notes.vue';
import NoteForm from './Notes/NoteForm';

export default {
    components: {
        Popper,
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
            loaded: false,
            notesCount: 0
        };
    },
    mounted() {
        this.notesCount = this.field.value;
    },
    methods: {
        loadNotes() {
            if (this.loaded) {
                return;
            }
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
                    this.loaded = true;
                });
        },
        pushNotes(data) {
            this.notes.push(data)
            this.notesCount = this.notes.length
        }
    },
};
</script>

<style scoped></style>

<style scoped src="../../sass/field.css"></style>
