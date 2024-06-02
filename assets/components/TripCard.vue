<script setup>
    import {ref} from 'vue'
    const props = defineProps({
        from : String,
        to : String,
        price : Number,
        company : String,
        isFavorite : Boolean,
        timeStart : String,
        timeEnd : String,
        flightTime : String,
    })
    const favorite = ref(props.isFavorite)
</script>

<template>
    <div>
        <div class="flex">
            <div class="flex flex-grow">
                <div class="text-blue-950 text-2xl w-1/2">{{props.company}}</div>
                <div class="mr-auto">
                    <div class="text-2xl">{{props.timeStart}} - {{props.timeEnd}}</div>
                    <div class="text-lg">Время в полете: {{props.flightTime}}</div>
                </div>
                <div @click="favorite = !favorite">
                    <v-icon v-if="!favorite" icon="mdi-heart-outline"></v-icon>
                    <v-icon v-else icon="mdi-heart"></v-icon>
                </div>
                
            </div>
        </div>
        <div class="flex mb-2">
            <div class="text-2xl text-blue-950 w-1/2">Цена: {{ props.price }} Р</div>
            <div class="mr-auto">
                <div class="font-bold">{{ props.from }} -> {{props.to}}</div>
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