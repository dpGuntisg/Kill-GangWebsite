<template>
  <div>

    <!-- YouTube iframe with progressive enhancement -->
    <vue-plyr :options="options">
      <div class="plyr__video-embed">
        <iframe
          :src="youtubeVideoUrl"
          allowfullscreen
          allowtransparency
          allow="autoplay"
        ></iframe>
      </div>
    </vue-plyr>
  </div>
</template>

<script>
import VuePlyr from 'vue-plyr';
import 'vue-plyr/dist/vue-plyr.css';

export default {
  components: {
    VuePlyr,
  },
  data() {
    return {
      youtubeVideoUrl: 'https://www.youtube.com/embed/bTqVqk7FSmY?amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1', // YouTube video URL
      options: {

      },
    };
  }
}
  
</script>



  