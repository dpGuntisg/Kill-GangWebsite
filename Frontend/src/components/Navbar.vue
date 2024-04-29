<template>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <div class="topnav" :class="{ 'responsive': isResponsive }" id="myTopnav">
    <RouterLink to="/home">HOME</RouterLink>
    <RouterLink to="/about">ABOUT US</RouterLink>
    <RouterLink to="/awards">AWARDS</RouterLink>
    <RouterLink to="/shop">SHOP</RouterLink>
    <RouterLink to="/home">CART</RouterLink>
    <RouterLink to="/profile">PROFILE</RouterLink>
    <RouterLink to="/">LOG OUT</RouterLink>
    <a href="javascript:void(0);" class="icon" @click="toggleMenu">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</template>

<script>
export default {
  name: "navbar",

  data() {
    return {
      isResponsive: false
    };
  },
  methods: {
    toggleMenu() {
      this.isResponsive = !this.isResponsive;
    }
  }
};
  
</script>



<style>



.topnav {
  width: 100vw;
  background-color: #000000d4;
  overflow: hidden;
  -webkit-box-shadow: 0px 0px 40px 20px rgba(82, 10, 10, 0.64);
  -moz-box-shadow: 0px 0px 40px 20px rgba(82, 10, 10, 0.64);
  box-shadow: 0px 0px 40px 20px rgba(82, 10, 10, 0.64);
  top: 0; 
}


.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-weight: 600;
  font-size: 17px;
}


.topnav a:hover {
  background-color: #5a5858;
  color: black;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}


@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive a.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

</style>
