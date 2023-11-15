<template>
  <section class="not-found general-pattern w-100 d-flex justify-content-center align-items-center">
    <div class="container">
      <div class="content w-100 d-flex align-items-center align-content-center justify-content-center flex-column">

        <h1 class="not-found-message">
          404
        </h1>

        <h4 class="heading">
          هذه الصفحه غير متاح الان
        </h4>

        <div class="buttons-contain">
          <NuxtLink :to="localePath('/')" class="btn btn-primary">
            <img src="@/assets/img/cart.svg" class="standard-img" alt="" />

            <span>
              الرجوع للرئيسية
            </span>

            <img src="@/assets/img/cart.svg" class="hover-img" alt="" />
          </NuxtLink>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
const localePath = useLocalePath();
</script>

<style lang="scss">
.not-found {
  height: 100vh;
  background-color: rgba($color: #058702, $alpha: 0.03);
  padding: 50px 0px;

  .content {
    .not-found-message {
      font-size: calc(10vw + 50px);
      margin: 0px;
      letter-spacing: 2px;
      font-weight: 900;
      position: relative;
      z-index: 9;
      color: var(--secondary-color);

      &::after {
        content: '';
        position: absolute;
        width: 50px;
        height: 50px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: -1;
      }
    }

    .heading {
      font-size: calc(1vw + 20px);
      font-weight: 700;
      color: var(--primary-color);
      margin: 0px 0px 20px;
    }
  }
}

@media (max-width: 1200px) {
  .not-found .content .not-found-message::after {
    width: 30px;
    height: 30px;
    background: url('/assets/img/logo_icon.svg') center / contain no-repeat;
  }
}
</style>