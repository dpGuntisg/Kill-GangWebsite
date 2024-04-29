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
      youtubeVideoUrl: 'https://www.youtube.com/watch?v=iBxRQ5dqVTA&list=PLKfW-GqEVgY3dH1JxVPGJKxRxkia-OCDI&index=201&ab_channel=ICETEA', 
      options: {

      },
    };
  }
}
  
</script>



  