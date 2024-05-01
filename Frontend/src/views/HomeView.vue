<template>

  <navbar></navbar>
  <div class="container">
    <h1>NEWEST KILL GANG CONTENT</h1>
    <div class="Video-box">
      <div class="video-container">
        <VideoPlayer class="VideoPlayer" />
      </div>
      <div class="comment-container">
        <CommentSection class="CommentSection" />
      </div>
    </div>
    <div class="Song-Box"></div>
  </div>

</template>

<script>
import VideoPlayer from "../components/VideoPlayer.vue";
import Navbar from '../components/Navbar.vue';


export default {
name: "home",
components: {
  Navbar,
  VideoPlayer,

}
};
</script>

<style scoped>

h1{
  margin-top: 50px;
  text-align: center;
  font-weight:800;
  font-size: 70px;
  display: block;
}

.Video-box {
  margin-top: 50px;
  display: flex;
  justify-content: space-between;
  background-color: #220909b2;
}

.VideoPlayer{
  top: 300px;
  display: block;
  width: 100%;
  height: 500px;
  aspect-ratio: 16/9;
}

.CommentSection {
  width: 30%;
  text-align: center;
}

.container{
  background-color: #00000026;
  margin-left: 10%;
  margin-right: auto;
  text-align: left;
  max-width: 80vw;
  padding: 0 20px;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}


@media screen and (max-width: 1400px) {
    .container{
      max-width: none;
      margin-left: 0;
      margin-right: 0;
    }
    .Video-box {
    flex-direction: column;
    align-items: center;
  }
}

@media screen and (max-width: 768px){
  .VideoPlayer{
  top: 300px;
  display: block;
  width: 100%;
  height: 500px;
  aspect-ratio: 9/16;
}
}
  



</style>
