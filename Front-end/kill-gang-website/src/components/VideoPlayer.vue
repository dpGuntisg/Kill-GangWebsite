<template>
  <div class="videoplayer">
    <video ref="videoPlayer" controls>
      <source :src="videoPath" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
</template>

<script>
export default {
  data() {
    return {
      videoPath: "../assets/videos/test.mp4", 
    };
  },
};
</script>

<style scoped>

.videoplayer {
  width: 100%; 
}
</style>

  