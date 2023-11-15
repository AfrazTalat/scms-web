<template>
  <section class="news-details">
    <div class="container">
      <div class="row" v-if="!loading">
        <div class="col-12">
          <div class="content">
            <div class="image-content">
              <img :src="article.banner ? article.banner.preview : undefined" :alt="article.title" />
            </div>

            <h4>{{ article.title }}</h4>

            <div class="data">
              <img src="@/assets/img/clock.svg" />

              <span>{{ $dayjs(article.created_at).locale($i18n.locale).format('YYYY-MM-DD hh:mm A') }}</span>
            </div>

            <p>{{ article.description }}</p>

            <ShareIconsBox label="شارك الخبر" :title="article.title"></ShareIconsBox>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
import ShareIconsBox from "~/components/shared/ShareIconsBox.vue";
import { IArticle } from "~/types/content"

withDefaults(defineProps<{
  loading?: boolean,
  article: IArticle
}>(), {
  loading: false
})

const localePath = useLocalePath();
</script>

<style lang="scss">
.news-details {
  width: 100%;
  padding: 0px 0px 90px 0px;
  background-color: #fff;
  position: relative;
  z-index: 99;

  .content {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
    align-items: center;
    text-align: center;

    .image-content {
      width: 100%;
      height: auto;
      margin-top: -75px;
      border-radius: 6px;
      border: 1px solid rgba($color: #14a1d5, $alpha: 0.06);
      box-shadow: 0px 0px 20px rgba($color: #058702, $alpha: 0.06);
      overflow: hidden;

      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
      }
    }

    h4 {
      font-size: 30px;
      font-weight: 900;
      line-height: 40px;
      color: var(--dark);
      margin: 50px 0px 20px 0px;
    }

    .data {
      width: 190px;
      height: 40px;
      background-color: rgba($color: #058702, $alpha: 0.05);
      border-radius: 25px;
      display: flex;
      align-content: center;
      align-items: center;
      margin: 20px 0px;

      img {
        width: 20px;
        height: 20px;
        object-fit: contain;
        margin-inline-end: 7px;
      }

      span {
        color: var(--secondary-color);
        font-size: 14px;
        font-weight: 500;
        line-height: 17px;
      }
    }

    p {
      width: 100%;
      padding: 60px 0px;
      border-top: 1px solid rgba($color: #058702, $alpha: 0.1);
      border-bottom: 1px solid rgba($color: #058702, $alpha: 0.1);
      margin: 50px 0px;
      color: var(--dark);
      font-size: 16px;
      font-weight: 500;
      line-height: 25px;
    }
  }
}

@media (max-width: 999px) {
  .news-details {
    .share-list {
      flex-wrap: wrap !important;
    }
  }
}
</style>