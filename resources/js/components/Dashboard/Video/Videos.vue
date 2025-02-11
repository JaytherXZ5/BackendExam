<template>
    <div class="border flex flex-row flex-1 gap-5 m-5 w-full rounded-md ">
        <div class="p-2 w-[50%]">
            <video-player
                src="https://vjs.zencdn.net/v/oceans.mp4"
                controls
                poster="/upload/bg.png"
                :loop="true"
                :volume="0.6"
                @mounted="onMounted"
                @ready="onReady"
                @play="onPlay"
                @pause="onPause"
                @ended="onEnded"
                @seeking="onSeeking"
                
                class="w-[100%]"
            />
        </div>
        <div class="p-2 w-[50%]">
            <video-player
                src="https://vjs.zencdn.net/v/oceans.mp4"
                controls
                :loop="true"
                :volume="0.6"
                @mounted="onMounted"
                @ready="onReady"
                @play="onPlay"
                @pause="onPause"
                @ended="onEnded"
                @seeking="onSeeking"
                
                class="w-[100%]"
            />
        </div>
        <div class="p-2 w-[50%]">
            <video-player
                src="https://vjs.zencdn.net/v/oceans.mp4"
                controls
                :loop="true"
                :volume="0.6"
                @mounted="onMounted"
                @ready="onReady"
                @play="onPlay"
                @pause="onPause"
                @ended="onEnded"
                @seeking="onSeeking"
                
                class="w-[100%]"
            />
        </div>
    </div>
</template>
<script setup>
    import {VideoPlayer} from '@videojs-player/vue';
    import { onMounted } from 'vue';
    import { ref } from 'vue';
    import "video.js/dist/video-js.css";

    let currentTime = ref(0);
    let isPlaying = ref(false);


    onMounted((player) => {
        console.log("Video player mounted", player)
    })
</script>

<style scoped>

</style>