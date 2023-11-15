<template>
  <div>
    <sub-header />
    <news-data />
  </div>
</template>
<script lang="ts" setup>
import NewsData from '@/components/news/news-data.vue';
import SubHeader from '@/components/news/sub-header.vue';
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('articles.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('articles.meta.description'),
    }
  ]
});

</script>