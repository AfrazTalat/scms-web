<template>
  <section class="about-eco-clean">
    <div class="container">
      <div class="row mb-5" v-for="(data, i) in aboutList" :key="i">
        <div class="col-lg-7 col-12"
          :class="i % 2 === 0 ? `order-0 order-mobile-1 mr-auto` : `order-1 order-mobile-1 ml-auto`">
          <div class="content">
            <h4>
              {{ data.title }}
            </h4>

            <p>
              {{ data.desc }}
            </p>

            <!-- <div class="buttons-contain">
              <NuxtLink :to="localePath('/')" class="btn btn-success">
                <img src="@/assets/img/document.svg" class="standard-img" alt="" />

                <span>
                  {{ $t('common.company_profile') }}
                </span>

                <img src="@/assets/img/document.svg" class="hover-img" alt="" />
              </NuxtLink>
            </div> -->
          </div>
        </div>

        <div class="col-lg-4 col-12" :class="i % 2 === 0 ? `order-1 order-mobile-0` : `order-0 order-mobile-0`">
          <div class="image-content">
            <img :src="`/assets/img/${data.img}.png`" :class="i % 2 === 0 ? `order-left` : `order-right`" alt="" />
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-lg-6 col-12 border-shape mb-3">
          <div class="box blue">
            <div class="box-img">
              <img src="@/assets/img/blue_vision.svg" alt="">
            </div>

            <h4>
              {{ $t('about.our_vision') }}
            </h4>

            <p>
              {{ $t('about.our_vision_description') }}
            </p>
          </div>
        </div>

        <div class="col-lg-6 col-12 mb-3">
          <div class="box green">
            <div class="box-img">
              <img src="@/assets/img/work.svg" alt="">
            </div>

            <h4>
              {{ $t('about.our_mission') }}
            </h4>

            <p>
              {{ $t('about.our_mission_description') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts">
import { defineComponent } from "vue"

export default defineComponent({
  data() {
    return {
      aboutList: [
        {
          title: this.$t('about.about_section1_title'),
          desc: this.$t('about.about_section1_desc'),
          img: 'about_1'
        },
        {
          title: this.$t('about.about_section2_title'),
          desc: this.$t('about.about_section2_desc'),
          img: 'about_2'
        }
      ]
    }
  }
})
</script>

<style lang="scss">
.about-eco-clean {
  width: 100%;
  padding: 90px 0px 0px;
  background-color: var(--light);

  .content {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;

    h4 {
      color: var(--dark);
      font-size: 30px;
      font-weight: 900;
      line-height: 40px;
      margin: 0px;
    }

    p {
      font-size: 16px;
      font-weight: 500;
      line-height: 25px;
      margin: 40px 0px;
      color: var(--dark);
    }
  }

  .image-content {
    width: 100%;
    height: 100%;

    img {
      width: 385px;
      height: 385px;
      border-radius: 50%;
      object-fit: cover;

      &.order-left {
        margin-left: auto;
      }

      &.order-right {
        margin-right: auto;
      }
    }
  }

  .box {
    width: 90%;
    text-align: center;
    transition: all .3s linear;

    &.blue {
      margin-left: auto;

      .box-img {
        border: 1px solid rgba($color: #14A1D5, $alpha: 0.10);
        background-color: rgba($color: #14A1D5, $alpha: 0.03);
      }

      &:hover {
        h4 {
          color: #14A1D5;
        }
      }
    }

    &.green {
      margin-right: auto;

      .box-img {
        border: 1px solid rgba($color: #058702, $alpha: 0.10);
        background-color: rgba($color: #058702, $alpha: 0.03);
      }

      &:hover {
        h4 {
          color: #058702;
        }
      }
    }

    &.orange {
      margin-right: auto;

      .box-img {
        border: 1px solid rgba($color: #f48c31, $alpha: 0.10);
        background-color: rgba($color: #f48c31, $alpha: 0.03);
      }

      &:hover {
        h4 {
          color: #f48c31;
        }
      }
    }

    .box-img {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      margin: auto;
      display: flex;
      align-items: center;
      align-content: center;
      justify-content: center;


      img {
        width: 70px;
        height: 70px;
        object-fit: contain;
      }
    }

    h4 {
      color: var(--dark);
      font-size: 30px;
      font-weight: 900;
      margin: 24px 0px 30px 0px;
    }

    p {
      font-size: 16px;
      font-weight: 500;
      line-height: 25px;
      color: var(--dark);
    }

    &:hover {
      transform: translateY(-10px);

      img {
        animation: toRightFromLeft .4s linear;
      }
    }
  }

  .border-shape {
    position: relative;

    &::after {
      content: '';
      position: absolute;
      width: 1px;
      height: 50%;
      left: -10px;
      top: 25%;
      background-color: rgba($color: #14A1D5, $alpha: 0.150);
    }
  }
}

@media (max-width: 999px) {
  .about-eco-clean {
    .image-content img {
      width: 300px;
      height: 300px;
      margin: 0px auto 40px !important;
    }

    .order-mobile-0 {
      order: 0 !important;
    }

    .order-mobile-1 {
      order: 1 !important;
    }

    .border-shape::after {
      width: 50%;
      height: 1px !important;
      top: unset !important;
      left: 25%;
      bottom: 0px;
    }

    .box {
      width: 100% !important;
    }
  }
}
</style>