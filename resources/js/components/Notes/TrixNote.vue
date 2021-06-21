<template>
    <div>
        <input type="hidden" id="input-trix" name="content" ref="inputEl" >
        <trix-editor input="input-trix"></trix-editor>
    </div>
</template>
<script>
export default {
    methods:{
        setTextToTrix(){
           this.text=this.$refs.inputEl.value
           this.$emit('change', this.text)
        }
    },
    mounted(){
        document.addEventListener("trix-change",this.setTextToTrix)
    },
    beforeDestroy(){
        document.removeEventListener("trix-change",this.setTextToTrix)
    }
}
</script>
