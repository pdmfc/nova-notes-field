<template>
    <popper
        trigger="clickToToggle"
        append-to-body
        :options="popperOptions">
        <div class="popper" style="width: 400px;">
            <div v-for="note in notes">
                {{ note.note }}<br>
                {{ note.created_at }}
            </div>
            <input type="text" v-model="newNote" @keyup.enter="onSubmit"/>
        </div>
        <div slot="reference"
             class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltip no-underline relative"
             @click="loadNotes">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-current">
                <path
                    d="M2 15V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v15a1 1 0 0 1-1.7.7L16.58 17H4a2 2 0 0 1-2-2zM20 5H4v10h13a1 1 0 0 1 .7.3l2.3 2.29V5z"/>
            </svg>
            <div v-if="notesCount > 0"
                 class="absolute px-2 py-1 rounded-full text-white text-xs bg-primary font-bold pin-t pin-l ml-4 -mt-3">
                {{ notesCount }}
            </div>
        </div>
    </popper>
</template>

<script>
import Popper from 'vue-popperjs'
import 'vue-popperjs/dist/vue-popper.css'

export default {
    components: {
        Popper
    },
    props: ['resourceName', 'field'],
    data () {
        return {
            popperOptions: {
                placement: 'left',
                modifiers: {
                    offset: {offset: '0,10px'},
                }
            },
            newNote: '',
            notes: [],
            notesCount: 0,
            loaded: false
        }
    },
    mounted () {
        this.notesCount = this.field.value
    },
    methods: {
        onSubmit () {
            Nova.request()
                .post('/nova-vendor/notes-field/new', {
                    note: this.newNote,
                    notable_id: this.field.notable_id,
                    notable_type: this.field.notable_type
                })
                .then(({data}) => {
                    this.notes.push(data)
                    this.notesCount = this.notes.length
                    this.newNote = ''
                })
        },

        loadNotes () {
            if (this.loaded) {
                return
            }
            Nova.request()
                .get(
                    `/nova-vendor/notes-field?notable_id=${this.field.notable_id}&notable_type=${this.field.notable_type}`)
                .then(({data}) => {
                    this.notes = data
                    this.notesCount = this.notes.length
                    this.loaded = true
                })
        }
    }
}
</script>
