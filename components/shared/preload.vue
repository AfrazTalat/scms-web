<template>
  <section class="loader w-100 d-flex align-items-center align-content-center justify-content-center">
    <div class="content d-flex align-items-center align-content-center justify-content-center flex-column">
      <!-- <img src="@/assets/img/your-logo.png" alt=""> -->
      <SharedAppLogo />
    </div>
  </section>
</template>

<style lang="scss">
  .loader {
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999;
    background-color: #004e77;

    .content {
      width: 150px;
      height: 150px;
      position: relative;
      z-index: 9;

      &::after {
        content: '';
        position: absolute;
        height: 150px;
        width: 150px;
        z-index: -1;
        border-radius: 50%; 
        top: 0;
        left: 0;
        animation: animate2 1.5s linear infinite;
        clip: rect(0, 80px, 80px, 40px);
      }
    }
  }

  @keyframes animate2 {
    0% {
      box-shadow: inset #fff 0 0 0 2px;
      transform: rotate(0deg);
    }

    50% {
      box-shadow: inset #fff 0 0 0 4px;
    }
    
    100% {
      box-shadow: inset #fff 0 0 0 2px;
      transform: rotate(360deg);
    }
  }
</style>