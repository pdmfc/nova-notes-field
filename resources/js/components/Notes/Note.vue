<template>
    <li class="flex text-left bg-indigo overflow-hidden px-4 py-4">
        <div class="mr-4 flex-shrink-0">
            <img
                class="inline-block h-16 w-16 rounded-full"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt=""
            />
        </div>
        <div>
            <div class="flex space-x-2">
                <h4 class="text-lg font-semibold">{{ data.author ? data.author.name : '-' }}</h4>
                <icon-eye-off v-if="data.personal" />
            </div>

            <p
                class="trix-content my-3"
                v-if="data.as_html"
                v-html="data.note"
            ></p>
            <p class="my-3" v-else>{{ data.note }}</p>

            <p class="text-gray-500">{{ createdAt }}</p>

            <div v-if="!isReply" class="w-full my-1">
                <a @click="handleReplyTo" class="no-underline dim text-primary font-bold cursor-pointer">Reply</a>
            </div>

            <div v-if="!isReply" v-for="note in data.notes" class="mt-6 flex">
                <note :data=note :key="note.note"></note>
            </div>
        </div>


    </li>
</template>

<script>
import moment from 'moment/min/moment-with-locales';
import IconEyeOff from '../icons/IconEyeOff.vue';

export default {
    name: 'note',
    components: {
        IconEyeOff,
    },
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            isReply: this.data.notable_type === "PDMFC\\NovaNotesField\\Models\\Note"
        }
    },
    created() {
        moment.locale(Nova.config.locale);
    },
    methods: {
        handleReplyTo() {
            this.$emit('reply-to', {
                notable_type: this.data.notable_type,
                notable_id: this.data.notable_id,
                reply_to_id: this.data.id,
                reply_to_name: this.data.author ? this.data.author.name : '-'
            });
        },

        onDelete(){ 
              
        //get NOTE ID 

        console.log(this.data) 

        Nova.request().delete('/nova-vendor/notes-field/'+this.data.id).then(response => { 
               
            this.$toasted.show('It worked!', { type: 'success' }) 

        }) 

        }, 

    onEdit(){ 
        alert('Opened on edit') 
        //get NOTE ID 
        console.log(this.data) 
        Nova.request().put('/nova-vendor/notes-field/'+this.data.id).then(response => { 
        this.$toasted.show('It worked!', { type: 'success' }) 
        if(!isReply){ 
        this.$emit('updateReply',{ 
        notable_type: this.data.notable_type, 
        notable_id: this.data.notable_id, 
        reply_to_id: this.data.id, 
        reply_to_name: this.data.author ? this.data.author.name : '-' 
        }) 
        } 
        }) 
        //check personal status 
        //display note 
        //update changes 

    },
        },

    computed: {
        createdAt() {
            return `${moment(this.data.created_at).fromNow()} - ${moment(
                this.data.created_at
            ).format('DD/MM/YY HH:mm')}`;
        },
    },
};
</script>

<style scoped src="../../../sass/field.css"></style>
