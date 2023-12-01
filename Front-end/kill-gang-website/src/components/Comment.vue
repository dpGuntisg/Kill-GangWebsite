<template>
  <div class="comment-section">
    <h2>Comments</h2>
    <div v-for="(comment, index) in comments" :key="index" class="comment">
      {{ comment }}
    </div>
    <div class="comment-input">
      <textarea class="comment-inp" v-model="newComment" placeholder="Add a comment..."></textarea>
      <button class="submit-btn" @click="submitComment">Submit</button>
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
  display: flex;
  height: 1.5rem;
}

.comment-inp {
  background-color: black;
  border: none;
  color: white;
}

.submit-btn{
  background-color: black;
  color:dimgrey;
  border: none;
}
</style>
