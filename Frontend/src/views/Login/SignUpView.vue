<template>
    <div class="content">
      <form>
        <h1>KILL GANG</h1>
          <div class="input-container">
            <input v-model="name" type="Name" class="Name" placeholder="Name" required>
            <input v-model="email" type="email" class="Login-email" placeholder="E-mail" required>
            <input v-model="password" type="password" class="Login-password" placeholder="Password" required>
            <input v-model="passwordConfirmation" type="password" class="Login-password" placeholder="Confirm your password" required>
          </div>
      </form>
        <div class="button-container">
            <RouterLink to="/">
                <button class="login-btn">LOGIN</button>
            </RouterLink>
            <RouterLink to="/signup" id="signup">
                <button @click.prevent="register" class="signup-btn">SIGN UP</button>
            </RouterLink>
        </div>
    </div>
    
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'MyComponent',
  
    data() {
      return {
        name: '',
        email: '',
        password: '',
        passwordConfirmation: '',
        errorMessage: ''  // To display error message to the user
      };
    },
  
    methods: {
      register() {
        axios.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.passwordConfirmation,
        })
        .then(response => {
          console.log('Registration successful:', response.data);
          // Redirect or clear form here
          this.$router.push({ name: 'login' });
        })
        .catch(error => {
          console.error('Registration failed:', error.response.data);
          this.errorMessage = error.response.data.message || 'Something went wrong';
        });
      }
    }
  }
  </script>
  
  
  
  <style scoped>
  

.content {
  height: 600px;
  overflow: hidden;
  overflow: none;
  margin-top: 30vh;
  margin-bottom: 30vh;
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 500px;
  flex-direction: column;
  padding: 30px;
  position: relative;
  background: rgba(3, 3, 3, 0.45);
  border-radius: 3%;
  box-shadow: 10px 2px 4px rgba(0, 0, 0, 0.1);
  -webkit-box-shadow:0px 0px 238px 70px rgba(82,10,10,1);
  -moz-box-shadow: 0px 0px 238px 70px rgba(82,10,10,1);
  box-shadow: 0px 0px 238px 70px rgba(82,10,10,1);
}

h1 {
    font-size: 80px;
    font-weight: bold;
    justify-content: center;
    align-content:center; 
    display:flex;
}

.input-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-top: 20px;
}

.Login-email,
.Name,
.Login-password {
    border-radius: 4%;
    background-color: rgba(3, 3, 3, 0.45); ;
    margin-top: 20px;
    margin-bottom: 20px;
    border: none;
    color: rgb(156, 154, 154);
    height: 40px;
    width: 250px;
    text-indent: 10px;
    
}

.login-btn,
.signup-btn {
  width: 100px ;
  border-radius: 5px;
  color: #ffffff;
  background-color: #4a0000; 
  border: none;
  cursor: pointer;
  padding: 10px 20px;
  transition: background-color 0.2s ease-in;
  margin: 0 30px;
  margin-top: 20px;
}

.login-btn:hover,
.signup-btn:hover {
    background-color: #d5d5d5;
    box-shadow: 0 0 30px #4a0000;
}

@media (max-width: 768px) {
    .content {
    margin-top: 0;
    border-radius: 0%;
    height: 100vh;
    overflow: hidden;
    width: 100%;
    font-size: 18px;
    margin-bottom: 0;
    }

    .input-container{
      margin-top: 1px;
    }

    h1{
      font-size: 50px;
      margin-left: 33%;
      justify-content: center;
      align-content:center; 
      display:flex;
    }
}

@media (min-width: 1200px) {
    .content {
    overflow: hidden;
    font-size: 24px;
    }
}
.button-container {
  margin: 0;
  position: relative;
  justify-content: center;
  display: flex;
  width: 100%;
}


  </style>