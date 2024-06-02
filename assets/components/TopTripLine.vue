<script setup>
    import {ref} from 'vue'
    const props = defineProps({
        index : Number,
        from : String,
        to : String,
        views : Number
    })

    const from = ref(props.from)
    const to = ref(props.to)


</script>

<template>
    <div>
        <div class="flex border-solid h-10">
            <div class="mr-2 text-xl w-10">{{ index+1 }}</div>
            <div class="text-xl text-base-color mr-auto">{{ to }}</div>
            <div class="text-xl mr-2">{{views}}</div>
            <div class="text-xl mr-10">
                
                <v-icon icon="mdi-eye" size="small"></v-icon>
            </div>
            
            <div @click="$emit('checkTrip',from,to)">
                <v-icon icon="mdi-magnify" size="large"></v-icon>
            </div>
        </div>
        <div class="line"></div>
    </div>
    
</template>


<style scoped>
    .line{
        height: 2px;
        width: auto;
        border-radius: 2px;
        background-color: gray;
    }
</style>