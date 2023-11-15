<template>
  <section class="news">
    <div class="container">

      <Loader :loading="loading"></Loader>
      <div class="row" v-if="!loading">
        <div class="col-lg-6 col-12 mb-3" v-for="(article, i) in articlesList?.list" :key="i">
          <news-box :article="article" />
        </div>
      </div>

      <div class="mt-4" v-if="articlesList?.pagination">
        <b-pagination v-model="articlesList.pagination.current_page" :total-rows="articlesList.pagination.total"
          :per-page="articlesList.pagination.per_page" class="numbers-list"></b-pagination>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
import NewsBox from '../core/news-box.vue';
import Loader from '../shared/loader.vue';
import { useArticles } from '~/stores/content/articles';

const localePath = useLocalePath();

const loading = ref(false);
const articles = useArticles();

const articlesList = await (await useAsyncData("news-list", () => articles.fetchArticles()
  .finally(() => loading.value = false))).data.value;
</script>


<style lang="scss" scoped>
.news {
  width: 100%;
  padding: 90px 0px;
  background-color: #fff;
}
</style>