<template>
    <div>
        <input type="hidden" id="input-trix" name="content" ref="inputEl" >
        <trix-editor input="input-trix"></trix-editor>
    </div>
</template>
<script>
export default {
    props: {
        value: {
            type: String
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
    }
}
</script>
