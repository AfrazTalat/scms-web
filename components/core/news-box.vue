<template>
  <b-card v-if="article" :title="article.title" :img-src="article.banner ? article.banner.preview : undefined"
    :img-alt="article.title" img-top class="news-box">
    <div class="data">
      <img src="@/assets/img/clock.svg" />

      <span>{{ $dayjs(article.created_at).locale($i18n.locale).format('YYYY-MM-DD hh:mm A') }}</span>
    </div>
    <b-card-text>{{ article.description }}</b-card-text>

    <NuxtLink class="see-more-btn" :to="localePath(`/news/${article.id.toString()}`)">
      <img src="@/assets/img/blue_arrow.svg" />

      <span>{{ $t('common.view_details') }}</span>
    </NuxtLink>
  </b-card>
</template>

<script lang="ts" setup>
import { IArticle } from '~/types/content';

const props = defineProps<{
  article: IArticle,
}>();

const localePath = useLocalePath();
</script>

<style lang="scss">
.news-box {
  width: 100%;
  height: 100%;
  display: flex;
  align-content: center;
  align-items: center;
  justify-content: space-between;
  flex-direction: row;
  background-color: #fff;
  border-radius: 6px;
  overflow: hidden;
  box-shadow: 0px 0px 20px rgba($color: #058702, $alpha: 0.06);
  transition: all 0.3s linear;
  border: 0px !important;

  .card-img-top {
    width: 220px;
    height: 100%;
    object-fit: cover;
  }

  .card-body {
    width: calc(100% - 220px);
    padding-top: 24px;
    padding-bottom: 24px;
    padding-inline-start: 26px;
    padding-inline-end: 17px;

    .card-title {
      color: var(--dark);
      font-size: 18px;
      font-weight: 900;
      line-height: 30px;
      margin: 0px;
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

    .card-text {
      color: #989898;
      font-size: 14px;
      font-weight: 500;
      line-height: 19px;
      margin-bottom: 20px;
    }

    .see-more-btn {
      display: flex;
      align-content: center;
      align-items: center;
      background-color: transparent !important;
      border: 0px !important;
      outline: none !important;

      img {
        width: 24px;
        height: 24px;
        object-fit: contain;
        margin-inline-end: 8px;
      }

      span {
        color: var(--primary-color);
        font-size: 16px;
        font-weight: 900;
        line-height: 19px;
      }

      &:hover {
        img {
          animation: translateX 1s linear infinite;
        }
      }
    }
  }

  &:hover {
    transform: translateY(-10px);
  }
}

@media (max-width: 999px) {
  .news-box {
    flex-direction: column !important;

    .card-img-top,
    .card-body {
      width: 100% !important;
    }

    .card-img-top {
      height: 260px !important;
    }
  }
}
</style>