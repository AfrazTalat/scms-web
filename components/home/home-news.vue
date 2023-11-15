<template>
  <section class="news general-pattern">
    <div class="container">
      <div class="general-heading">
        <h1>{{ $t('articles.our_news') }}</h1>

        <p>{{ $t('articles.our_news_subtitle') }}</p>

        <img src="@/assets/img/head_icon.svg" />
      </div>


      <Loader :loading="loading"></Loader>

      <div class="row" v-if="!loading">
        <div class="col-lg-6 col-12 mb-4" v-for="(article, i) in articlesList?.list" :key="i">
          <news-box :article="article" />
        </div>

        <div class="col-12">
          <div class="buttons-contain">
            <NuxtLink :to="localePath('/news')" class="btn btn-primary">
              <img src="@/assets/img/arrow_left.svg" class="standard-img" />

              <span>{{ $t('articles.view_more_news') }}</span>

              <img src="@/assets/img/arrow_left.svg" class="hover-img" />
            </NuxtLink>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup async>
import NewsBox from '../core/news-box.vue';
import Loader from '../shared/loader.vue';
import { useArticles } from '~/stores/content/articles';

const localePath = useLocalePath();

const loading = ref(false);
const articles = useArticles();

const articlesList = await (await useAsyncData("home-news", () => articles.fetchArticles()
  .finally(() => loading.value = false))).data.value;
</script>

<style lang="scss" scoped>
.news {
  width: 100%;
  padding: 90px 0px;
  background-color: #fcfcfc;

  &::after {
    transform: scaleX(-1);
    height: 90%;
  }

  .buttons-contain {
    width: 100%;
    justify-content: center !important;
    margin-top: 40px;

    .btn-primary {
      width: 220px !important;
    }
  }
}
</style>