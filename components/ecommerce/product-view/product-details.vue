<template>
  <section class="project-details">
    <div class="container" v-if="product">
      <div class="row">
        <div class="col-lg-5 col-12 mb-4">
          <div class="image-conetnt">
            <BCarousel class="flex-grow-1 w-100" controls>
              <BCarouselSlide v-for="image in product.images" :key="image?.id" :img-src="image?.preview" />
            </BCarousel>
          </div>
        </div>

        <div class="col-lg-6 col-12 ml-auto">
          <div class="content">
            <div class="type" v-if="product.category">{{ product.category.name }}</div>

            <h1>{{ product.name }}</h1>

            <ul class="project-list">
              <!-- <li>
                <span>بلد الصنع</span>
                <img src="@/assets/img/product_logo_1.webp" alt />
              </li>-->

              <li v-if="product.brand">
                <span>{{ $t('ecommerce.brand') }}</span>
                <img v-if="product.brand.logo" :src="product.brand.logo.preview" :alt="product.brand.name" />
              </li>
            </ul>

            <p class="desc">{{ product.subtitle }}</p>

            <div class="buttons-contain data">
              <h4>{{ $t('ecommerce.more_product_details') }}</h4>

              <a v-if="product.pdf" :href="product.pdf.preview" target="_blank" download class="btn btn-outline-primary">
                <img src="@/assets/img/blue_file.svg" class="standard-img" />

                <span>{{ $t('ecommerce.download_catalog') }}</span>

                <img src="@/assets/img/blue_file.svg" class="hover-img" />
              </a>
            </div>

            <div class="d-flex align-items-center justify-content-between my-3">
              <p class="price m-0 flex-flow-1 w-100">{{ product.price }} ر.س</p>
              <div class="buttons-contain w-auto">
                <ProductCartButton :product-id="product.id" />
              </div>
            </div>

            <div class="buttons-contain">
              <!-- <a href="#" class="btn btn-success flex-grow-1">
                <img src="@/assets/img/cart.svg" class="standard-img" />

                <span>شراء المنتج من المتجر</span>

                <img src="@/assets/img/cart.svg" class="hover-img" />
              </a> -->

              <!-- <a href="#" class="share">
                <img src="@/assets/img/share_icon.svg" />
              </a> -->
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="more-info">
            <h2 class="title">{{ $t('ecommerce.product_details') }}</h2>

            <p>{{ product.description }}</p>

            <template v-if="youtubeVideoId">
              <h2 class="title">{{ $t('ecommerce.watch_product_details') }}</h2>

              <div class="video-contain">
                <iframe v-if="videoPlay == true" class="video-frame"
                  :src="`https://www.youtube.com/embed/${youtubeVideoId}?autoplay=1`" frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>
                <img v-if="videoPlay == false" src="@/assets/img/video_play.png" class="video-img" />

                <a v-if="videoPlay == false" href="javascript:void(0)" class="video-play" @click="videoPlay = true">
                  <img src="@/assets/img/video_icon.svg" class="video-icon" />
                </a>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>


<script lang="ts" setup>
import getYouTubeID from "get-youtube-id";
import { IProduct } from "~/types/resources/ecommerce"
import ProductCartButton from "../ProductCartButton.vue";

const props = withDefaults(defineProps<{
  loading?: boolean,
  product: IProduct
}>(), {
  loading: false
})

const videoPlay = ref(false);


const youtubeVideoId = computed<string | null>(() => {
  if (!props.product || !props.product.youtube_video) return null;
  if (!props.product.youtube_video.includes('youtube.com')) return props.product.youtube_video;
  return getYouTubeID(props.product.youtube_video);
})

const previewImage = computed<string | undefined>(() => {
  return props.product.images?.[0]?.preview;
})
</script>

<style lang="scss" scoped>
.project-details {
  width: 100%;
  padding: 90px 0px;
  background-color: var(--light);

  .image-conetnt {
    width: 100%;
    height: 431px;
    background-color: rgba($color: #14a1d5, $alpha: 0.03);
    border: 1px solid rgba($color: #14a1d5, $alpha: 0.06);
    border-radius: 6px;
    overflow: hidden;
    display: flex;
    align-items: center;
    align-content: center;
    justify-content: center;

    img {
      width: 50%;
      height: 50%;
      object-fit: contain;
      object-position: center;
    }
  }

  .content {
    width: 100%;

    .type {
      width: 230px;
      min-width: 230px;
      height: 45px;
      background-color: rgba($color: #058702, $alpha: 0.03);
      border: 1px solid rgba($color: #058702, $alpha: 0.05);
      border-radius: 25px;
      display: flex;
      align-items: center;
      align-content: center;
      justify-content: center;
      color: #058702;
      font-size: 15px;
      font-weight: 700;
      line-height: 18px;
    }

    h1 {
      color: var(--dark);
      font-size: 30px;
      font-weight: 900;
      margin: 20px 0px 30px;
    }

    .project-list {
      width: 100%;
      display: flex;
      align-content: center;
      align-items: center;

      li {
        display: flex;
        align-content: center;
        align-items: center;

        &:first-child {
          margin-inline-end: 20px;
          padding-inline-end: 20px;
          border-inline-end: 1px solid #e2e2e2;
        }

        span {
          color: #989898;
          font-size: 14px;
          font-weight: 700;
          line-height: 17px;
          margin-inline-end: 15px;
        }

        img {
          width: 125px;
          height: 30px;
          object-fit: contain;
        }
      }
    }

    .desc {
      font-size: 16px;
      font-weight: 500;
      line-height: 25px;
      margin: 30px 0px;
      color: var(--dark);
    }

    .buttons-contain {
      width: 100%;
      justify-content: space-between;

      &.data {
        padding: 20px 0px;
        border-top: 1px solid rgba($color: #058702, $alpha: 0.1);
        border-bottom: 1px solid rgba($color: #058702, $alpha: 0.1);
      }

      h4 {
        color: var(--dark);
        font-size: 16px;
        font-weight: 700;
        line-height: 25px;
        margin: 0px;
      }

      .btn {
        width: 185px !important;

        &.btn-success {
          width: calc(100% - 65px) !important;
        }
      }

      .share {
        width: 50px;
        height: 50px;
        background-color: #14a1d5;
        display: flex;
        align-content: center;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden;

        img {
          width: 24px;
          height: 24px;
          object-fit: contain;
        }

        &:hover {
          img {
            animation: toRightFromLeft 0.4s linear;
          }
        }
      }
    }

    .price {
      font-size: 30px;
      font-weight: 900;
      line-height: 30px;
      color: #058702;
      margin: 20px 0px;
    }
  }

  .more-info {
    width: 100%;
    padding: 65px 0px 0px;

    .title {
      color: var(--dark);
      font-size: 25px;
      font-weight: 900;
      line-height: 50px;
      text-align: center;
    }

    p {
      color: var(--dark);
      font-size: 16px;
      font-weight: 500;
      line-height: 25px;
      margin: 60px 0px 75px 0px;
    }

    .video-contain {
      width: 90%;
      height: auto;
      margin: 60px auto 0px !important;
      background-color: #058702;
      position: relative;
      border-radius: 10px;
      overflow: hidden;

      .video-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .video-play {
        width: 80px;
        height: 80px;
        position: absolute;
        top: calc(50% - 40px);
        left: calc(50% - 40px);
        z-index: 9;

        &:after {
          content: "";
          display: block;
          position: absolute;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          border-radius: 50%;
          overflow: hidden;
          z-index: -1;
          visibility: visible;
          animation: pulsecust 1.8s linear infinite;
          transition: visibility 0.1s ease-out, opacity 0.2s ease-out;
          background-color: #058702;
        }

        img {
          width: 80px;
          height: 80px;
          object-fit: contain;
        }
      }
    }
  }
}

@media (max-width: 999px) {
  .project-details {

    .project-list,
    .buttons-contain.data {
      flex-direction: column;
      align-items: flex-start !important;

      li {
        padding: 0px !important;
        margin: 0px !important;
        border: 0px !important;

        &:first-child {
          margin-bottom: 10px !important;
        }
      }

      h4 {
        text-align: center;
        margin-bottom: 10px !important;
      }
    }

    .buttons-contain.data {
      justify-content: center;
    }
  }
}
</style>