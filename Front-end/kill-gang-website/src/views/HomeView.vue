<template>
    <navbar></navbar>
  
    <div class="container">
       <div class="tekst"><h1>NEWEST CONTENT</h1></div> 
      <div class="Video-box">
        <VideoPlayer class="VideoPlayer"/>
        <CommentSection> </CommentSection> 
      </div>
      <div class="Song-Box">
        
      </div>
    </div>
  </template>
  
  <script>
  import VideoPlayer from "../components/VideoPlayer.vue";
  import Navbar from '../components/Navbar.vue';
  import CommentSection from '../components/CommentSection.vue';
  
  export default {
    name: "home",
    components: {
      Navbar,
      VideoPlayer,
      CommentSection
    },
  };
  </script>
  
  <style scoped>
  
  .tekst{
    margin-top: 5%;
    width: 100%;
    text-align: center;
    font-weight: 800;
    font-size: 40px;
  }

 
  .container{
    position: absolute;
    background-color: #360e0e;
    width: 80%;
    height: 100vh;
    margin-left: 10%;
  }
  
  .VideoPlayer{
    margin-top: 100px;
    margin-left: 10%;
    width: 30%;
    height: 30%;
  }
  
  
  </style>