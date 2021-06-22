<template>
    <div>
        <input type="hidden" id="input-trix" name="content" ref="inputEl" />
        <trix-editor class="trix-content" input="input-trix" :style="trixStyle"></trix-editor>
    </div>
</template>
<script>
export default {
    props: {
        value: {
            type: String
        },
        maxInputHeight: {
            type: String,
            default() {
                return '200px'
            }
        }
    },
    methods:{
        handleChange(){
           this.$emit('input', this.$refs.inputEl.value)
        }
    },
    mounted(){
        document.addEventListener("trix-change",this.handleChange)
    },
    beforeDestroy(){
        document.removeEventListener("trix-change",this.handleChange)
    },
    computed: {
        trixStyle() {
            return {
                maxHeight: this.maxInputHeight,
                overflowY: 'auto'
            }
        }
    }
}
</script>
