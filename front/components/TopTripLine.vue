<script setup>
    import {ref} from 'vue'
    const props = defineProps({
        index : Number
    })

    const from = ref('Липецк')
    const to = ref('Москва')

    function goFind(){

    }
</script>

<template>
    <div>
        <div class="flex border-solid h-10">
            <div class="mr-2 text-xl w-10">{{ index+1 }}</div>
            <div class="text-xl text-base-color mr-auto">{{ from }} -> {{ to }}</div>
            <div class="text-xl mr-10">00:00 - 21:00</div>
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