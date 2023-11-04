<template>

    <navbar></navbar>
    <div class="container">
      <div class="Video-box">
        <VideoPlayer class="VideoPlayer"/>
        <div class="comment-section"> </div>
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
    },
  };
  </script>
  
  <style>
  
  .container{
    position: absolute;
    background-color: #360e0e;
    width: 80%;
    height: 100vh;
    margin-left: auto;
    margin-right: auto;
  }
  
  .VideoPlayer{
  
    margin-left: 30%;
    width: 200px;
    height: 200px;
  }
  
  
  </style>