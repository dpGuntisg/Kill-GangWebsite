<template>
    <div class="comment-section">
      <h2>Comments</h2>
      <div v-for="(comment, index) in comments" :key="index" class="comment">
        {{ comment }}
      </div>
      <div class="comment-input">
        <textarea v-model="newComment" placeholder="Add a comment..."></textarea>
        <button @click="submitComment">Submit</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        newComment: '',
        comments: []
      };
    },
    methods: {
      submitComment() {
        if (this.newComment) {
          this.comments.push(this.newComment);
          this.newComment = '';
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .comment-input {
    margin-top: 20px;
  }
  </style>