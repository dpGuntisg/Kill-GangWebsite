<template>

    <navbar></navbar>
    <div class="container">
      <h1>NEWEST KILL GANG CONTENT</h1>
      <div class="Video-box">
        <VideoPlayer class="VideoPlayer" />
        <CommentSection class="CommentSection" />
      </div>
      <div class="Song-Box"></div>
    </div>

  </template>
  
  <script>
  import VideoPlayer from "../components/VideoPlayer.vue";
  import Navbar from '../components/Navbar.vue';
  import CommentSection from "../components/Comment.vue";
  
  export default {
  name: "home",
  components: {
    Navbar,
    VideoPlayer,
    CommentSection
  }
};
  </script>
  
  <style scoped>

  h1{
    margin-top: 100px;
    text-align: center;
    font-weight:800;
    font-size: 70px;
    display: block;
  }

  .Video-box {
    margin-top: 50px;
    display: flex;
    justify-content: space-between;
}

.VideoPlayer{
    top: 300px;
    display: block;
    margin-top: 50px;
    width: 1000px;
    height: 600px;
    margin-left: 12%;
  }

.CommentSection {
    margin-top: 45px;
    width: 100%;
}
  
  .container{
    background-color: #360e0e;
    margin-left: auto;
    margin-right: auto;
    text-align: left;
    max-width: 70vw;
    padding: 0 20px;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }
  

  
  </style>