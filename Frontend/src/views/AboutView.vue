<template>
  <navbar></navbar>
    <div class="text-div">
      <div class="text-box">
        <h1 class="kill-gang">KILL GANG</h1>
        <p>At Kill Gang, we're passionate about a diverse range of interests that bring together the best of the digital age.
          Our organization is committed to fostering creativity, entertainment, and innovation across various domains, making us a dynamic force in the modern world.</p>
        <p class="interests">Our Interests:</p>
        <ul>
          <li class="list"> <strong>E-Sports:</strong> We are avid supporters of the e-sports industry, where gamers showcase their skills and compete at the highest level. 
            We believe in the power of competitive gaming to build communities, connect people, and drive the evolution of digital sports. </li>
          <li class="list"><strong>Music Creation:</strong> Music is the universal language that transcends borders and cultures. We celebrate the art of music creation,
              offering platforms and resources to help aspiring musicians realize their dreams and connect with audiences worldwide.</li>
          <li class="list"><strong>Content Creation:</strong> In an era of digital storytelling, content creation is at the heart of our organization. 
            We empower content creators across various platforms to express themselves, share their passions, and engage with audiences through captivating content.</li>
          <li class="list"><strong>Gambling:</strong> We acknowledge the excitement and thrill that gambling brings to the lives of many.
              Our responsible gambling initiatives promote a safe and enjoyable environment for those who choose to engage in this form of entertainment.</li>
          <li class="list"><strong>World Dominance:</strong> While the term "world dominance" may sound ambitious, we are dedicated to making a global impact.
            Our commitment to excellence, innovation, and community engagement drives us to expand our influence positively and ethically in the digital realm.</li> 
        </ul>
      </div>
      <h1 class="members">MEMBERS</h1>
      <div class="members-container">
        <member
          v-for="member in members"
          :key="member.name"
          :name="member.name"
          :description="member.description"
          :image="member.image"
        />
      </div>
    </div>
  </template>
  
  
  <script>
  
  import navbar from '../components/Navbar.vue'
  import member from '@/components/members.vue'
  
  export default{
    name: "home",
    components:{
      navbar,
      member,
    },
    data() {
      return {
        members: [
          {
            name: 'Guapo',
            description: 'Guapo is a brilliant and cunning co-creator of Kill Gang. With sharp intellect and street smarts. Muscular and imposing, his presence commands respect. his strategic acumen has shaped the gang into a formidable force, expanding their influence across the world. Despite his cunning, he adheres to a strict dress code, earning loyalty from his associates',
            image: '/assets/Guntis.jpg'
          },
          {
            name: 'PINCIS',
            description: 'In the shadows, PINCIS reigns supreme—a blend of beauty, brains, and brawn. Regarded as the planets best fighter, he co-created Kill Gang. With striking allure and unmatched strength, he navigates the criminal world, his intelligence and strategic brilliance making him a force to be reckoned with. ',
            image: '/assets/Klavs.png'
          },
          {
            name: '-shr00m-',
            description: '-shr00m- is a hotheaded beatmaker. His intense nature fuels both his music and vices: a gambling addiction that leads him to risky situations and a snus habit that offers fleeting solace. Despite his struggles, -shr00m- compositions pulse with raw energy, becoming the heartbeat of the gangs operations. Hes a complex character, teetering on the edge of self-destruction, his art reflecting the whirlwind of his passions and vices.',
            image: '/assets/Kevin.jpg'
          },
          {
            name:'Erin',
            description: 'Erin, a member of Kill Gang, battled gambling addiction and alcoholism. Despite personal struggles, Erin managed the gangs crucial delivery service efficiently, becoming a linchpin in their operations. Additionally, Erin was a talented rapper, channeling their pain into raw and authentic lyrics. Their story exemplified resilience, showcasing how amidst personal chaos, individuals could excel professionally and creatively, leaving a lasting impact on those around them.',
            image: '/assets/monkey.jpg'
          },
          {
            name:'Stefans Filips Podgaiskis',
            description: 'Stefans Filips Podgaiskis, a member of the infamous Kill Gang, a deeply complex individual whose life was a turbulent blend of addiction, creativity, and despair. His story was one marked by intense struggles, as he battled not only drug and gambling addictions but also the haunting specter of suicidal thoughts. Despite these inner demons, he emerged as a creative powerhouse, becoming the backbone of Kill Gangs content creation.',
            image: '/assets/stefans.png'
          },
          {
            name:'Jonka',
            description: 'Jonka, a member of the infamous Kill Gang, a complex individual whose life was marked by a series of destructive habits. His story was one of addiction, both to gambling and alcohol, leading him down a perilous path. Despite the darkness that loomed over him, he was also known for his lighthearted and silly demeanor, earning him the nickname "silly goose" among his associates.  His lyrical prowess, despite its absurd and playful nature, was undeniable, earning him a peculiar kind of respect among his peers.',
            image: '/assets/Jekabs.png'
          },
          {
            name:'Cake Henrijs Apaļais',
            description: 'Cakes, a member of Kill Gang, led an unconventional life. Living in a basement on a farm, they found solace in online gaming, particularly League of Legends. Despite their gaming prowess, Cakes struggled with online school, facing challenges that led to academic setbacks. Their unique lifestyle reflected a blend of digital escapism and real-world struggles, making them a distinctive character within the gang.',
            image: '/assets/Henrijs.png'
          },
          {
            name:'who else',
            description: 'who?',
            image: '/assets/velo.png'
          }

        ]
      }
    }
  }
  </script>
  
  <style>
  @media screen and (max-width: 768px) {
    .text-div {
      padding: 0 20px;
      max-width: none;
      margin-left: none;
      margin-right: none;
    }
  
  }

  @media screen and (min-width: 768px) {
  .text-div{
    background-color: #00000026;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: left;
    padding: 0 20px;
    width: 80%;
    height: auto;
    margin-left: 10%;
  }
  .text-box{
    width: 80%;
  }

  .text-box p{
    text-align: center;
    font-weight: 500;
  }
}
  
  .kill-gang {
    margin-top: 10%;
    text-align: center;
    font-weight:800;
    font-size: 70px;
  }
  
  strong {
    font-weight:650;
  }
  
  .interests{
    margin-top: 30px;
    font-weight: 750;
    font-size: 25px;
    margin-bottom: 5px;
  }
  
  .list {
      margin-bottom: 10px;
      list-style-type:disc;
  }
  
  .members{
    margin-bottom: 3vh;
    margin-top: 10vh;
     text-align: center;
     font-weight:800;
     font-size: 60px;
  }
  
  
  .members-container {
    display: flex;
    flex-direction: column;
  }

  .member-pfp img {
    width: 200px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
  }

  </style>
