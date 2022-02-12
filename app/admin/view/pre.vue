<template>
    <pre>{{content}}</pre>
</template>

<script>
    export default {
        props:{
            modelValue:String    //必须实现value参数
        },
        data(){
            return {
                content:this.modelValue,
            }
        },
        watch:{
            content(val){
                this.$emit('update:modelValue', val)  //回传组件
            }
        }
    }
</script>

<style scoped>

</style>