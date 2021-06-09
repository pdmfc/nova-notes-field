<template>
    <popper trigger="clickToToggle"
            append-to-body
            boundaries-selector="body"
            :options="popperOptions">
        <div class="popper flex">
            <div
                class="bg-white flex-1 flex flex-col rounded-lg divide-y divide-gray-200"
            >
                <div class="overflow-y-auto flex-grow flex px-4 py-5" style="width: 400px; height: 400px; max-height: 400px; max-width:400px;">
                    <notes :notes="notes"></notes>
                </div>
                <div class="bg-gray-50 p-4">
                    <input-field
                        v-model="newNote"
                        @insert-message="onSubmit"
                        :errors="errors"
                    ></input-field>
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
import 'vue-popperjs/dist/vue-popper.css';
import Notes from './Notes/Notes.vue';
import InputField from './Notes/InputField.vue';

export default {
    components: {
        Popper,
        Notes,
        InputField
    },
    props: ['resourceName', 'field'],
    data () {
        return {
            popperOptions: {
                placement: 'left',
                modifiers: {
                    offset: {offset: '0, 10px'}
                }
            },
            newNote: '',
            notes: [],
            loaded: false,
            notesCount: 0,
            errors: []
        };
    },
    mounted () {
        this.notesCount = this.field.value;
    },
    methods: {
        onSubmit () {
            this.errors = [];
            Nova.request()
                .post('/nova-vendor/notes-field/new', {
                    note: this.newNote,
                    notable_id: this.field.notable_id,
                    notable_type: this.field.notable_type
                })
                .then(({data}) => {
                    this.notes.push(data);
                    this.notesCount = this.notes.length;
                    this.newNote = '';
                })
                .catch(e => {
                    this.errors = e.response.data.errors.note;
                });
        },
        loadNotes () {
            if (this.loaded) {
                return;
            }
            Nova.request()
                .get(
                    `/nova-vendor/notes-field?notable_id=${this.field.notable_id}&notable_type=${this.field.notable_type}`
                )
                .then(({data}) => {
                    this.notes = data;
                    this.notesCount = this.notes.length;
                    this.loaded = true;
                    this.errors = [];
                });
        }
    }
};
</script>

<style scoped>
    .popper {
        -moz-box-shadow: 0 2px 4px 0 rgb(0 0 0 / 5%) !important;
        -webkit-box-shadow: 0 2px 4px 0 rgb(0 0 0 / 5%) !important;
        box-shadow: 0 2px 4px 0 rgb(0 0 0 / 5%) !important;
        border: 0 !important;
        padding: 0 !important;
    }
</style>

<style scoped src="../../sass/tailwind.css"></style>
