<template>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-12">

        </div>
      </div>
    </div>

    <div class="home-sliders">
      <b-carousel :interval="4000" fade ride="carousel" controls indicators>
        <b-carousel-slide v-for="slider in slidersList?.list" :key="slider.id" :img-src="slider.image?.preview" />
      </b-carousel>
    </div>
  </header>
</template>

<script lang="ts" setup async>
import { useSliders } from '~/stores/content/sliders';
import SocialMedia from '../core/SocialMedia.vue';
import { useAlerts } from '~/stores/interface/alerts';

const localePath = useLocalePath();

const sliders = useSliders();

const slidersList = (await useAsyncData("home-sliders", () => sliders.fetchSliders())).data.value;

const testClicked = () => {
  useAlerts().add({
    title: 'Test',
    message: 'Test message',
    displaySeconds: 3,
    type: 'danger'
  })
}
</script>

<style lang="scss">
header {
  width: 100%;
  background-color: #004E77;
  position: relative;
  z-index: 6;

  &::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    // background: url('/assets/img/header.webp') top left / cover no-repeat;
    top: 0;
    left: 0;
    z-index: -2;
  }

  .content {
    width: 100%;
    padding-bottom: 112px;

    .sub-title,
    .desc {
      font-size: 16px;
      font-weight: 500;
      color: rgba($color: #fff, $alpha: 0.70);
      line-height: 19px;
      margin: 0px;
    }

    h1 {
      color: #fff;
      font-size: 35px;
      font-weight: 900;
      line-height: 50px;
      margin: 15px 0px 0px !important;

      span {
        color: var(--primary-color);
        font-size: 35px;
        font-weight: 900;
      }
    }

    .desc {
      line-height: 25px !important;
      margin: 30px 0px 40px 0px !important;
    }
  }

  .socail-contain {
    width: fit-content !important;

    h4 {
      position: relative;
      font-size: 16px;
      font-weight: 500;
      line-height: 19px;
      color: rgba($color: #fff, $alpha: 0.70);
      display: flex;
      align-content: center;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;

      &::after {
        content: '';
        width: 92px;
        height: 1px;
        background-color: rgba($color: #fff, $alpha: 0.10);
        display: inline-block;
      }
    }
  }
}
</style>
<style lang="scss">
.home-sliders {
  width: 100%;
  height: 444px;
  overflow: hidden;

  .home-sliders-item {
    width: 100%;
    height: 100%;
  }

  .slide {
    height: 100%;

    .carousel-inner {
      height: 100%;

      .carousel-item {
        background-size: cover;
        background-position: center top;
        height: 100%;
      }
    }
  }
}
</style>~/composables/stores/content/sliders