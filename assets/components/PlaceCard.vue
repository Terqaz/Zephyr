
<script setup>
    import {ref} from 'vue'

    const props = defineProps({
        name : String,
        stars : Number,
        isFavorite : Boolean,
    })

    const favorite = ref(props.isFavorite)
</script>

<template>
    <div class="card-size relative rounded-3xl base-color inline-block">
        <div class="text-white text-2xl relative top-8 left-8 font-bold">{{name}}</div>
        <div class="absolute bottom-8 left-8 w-20 flex">
            <v-icon  icon="mdi-star" color="yellow" size="large"></v-icon>
            <p class="text-white text-xl font-bold">{{stars}}</p>
        </div>
        <div @click="favorite = !favorite" class="absolute right-8 bottom-8">
            <v-icon v-if="favorite" icon="mdi-heart" color="white"></v-icon>
            <v-icon v-else icon="mdi-heart-outline" color="white"></v-icon>
        </div>
        
    </div>
</template>


<style  scoped>
    .card-size{
        width:  300px;
        height: 200px;
        margin-right: 25px;
        margin-bottom: 25px;
    }
</style>