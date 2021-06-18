<template lang="html">
    <div class="flex flex-col">
        <toggle v-model="isPrivate" icon="olho"></toggle>
        <toggle v-model="richText" icon="texto"></toggle>
        <div class="flex flex-col">
            <div class="flex flex-col space-y-2 " v-if="errors.length > 0">
                <p class="text-red-500" v-for="error in errors">{{ error }}</p>
            </div>
            <div class="mt-1 flex flex-wrap flex-row space-x-4">
                <input-field
                    class="flex-1"
                    v-model="newNote"
                    @enter="onSubmit"
                    :hasError="errors.length > 0"
                ></input-field>
                <div class="flex-no-shrink ml-auto">
                    <a
                        class=" btn btn-default btn-primary text-white cursor-pointer"
                        @click="onSubmit"
                        >Send</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Toggle from './Toggle.vue';
import InputField from './InputField';

export default {
    components: {
        Toggle,
        InputField
    },
    props : {
        notable_id: {
            type: Number,
            required: true
        },
        notable_type: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            isPrivate: false,
            richText: true,
            newNote: '',
            notesCount: 0,
            errors: []
        };
    },
    watch: {
        isPrivate(nv, ov) {
            console.log('isPrivate', nv, ov);
        },
        richText(nv, ov) {
            console.log('richText', nv, ov);
        },
    },
    computed: {},
    methods: {
        onSubmit() {
            this.errors = [];
            Nova.request()
                .post('/nova-vendor/notes-field/new', {
                    note: this.newNote,
                    notable_id: this.notable_id,
                    notable_type: this.notable_type,
                })
                .then(({ data }) => {
                    this.$emit('note-submit', data)
                    this.newNote = '';
                })
                .catch(e => {
                    if (e.response.data.errors.note) {
                        this.errors = e.response.data.errors.note;
                    }
                });
        }
    },
};
</script>
