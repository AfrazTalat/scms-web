<template>
  <div v-if="article">
    <news-header :loading="loading" :article="article" :key="`article-head-${article.id}`" />
    <news-details :loading="loading" :article="article" :key="`article-body-${article.id}`" />
  </div>
</template>
<script lang="ts" setup>
import NewsDetails from '@/components/news/news_details/news-details.vue';
import NewsHeader from '@/components/news/news_details/news-header.vue';
import { useArticles } from '~/stores/content/articles';
import { useSettings } from '~/stores/settings';
import { IArticle } from '~/types/content';

const route = useRoute();
const { t } = useI18n();
const { webTitle } = useSettings();

const loading = ref(false);

const articleReq = await useAsyncData<IArticle>("article-view", () => useArticles().getArticle(+route.params.id));
const article = ref(articleReq.data.value);

useHead({
  title: webTitle(article.value?.title),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: article.value?.title,
    }
  ]
});

watch(() => route.params.id, (val) => articleReq.refresh().then(() => article.value = articleReq.data.value))
</script>