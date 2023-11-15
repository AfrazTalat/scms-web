<template>
  <div>
    <home-intro />
    <home-about />
    <home-products />
    <home-trade-mark />
    <home-services />
    <home-partner />
    <home-news />
    <home-statistic />
  </div>
</template>
<script lang="ts" setup>
import HomeAbout from '@/components/home/home-about.vue';
import HomeIntro from '@/components/home/home-intro.vue';
import HomeNews from '@/components/home/home-news.vue';
import HomePartner from '@/components/home/home-partner.vue';
import HomeProducts from '@/components/home/home-products.vue';
import HomeServices from '@/components/home/home-services.vue';
import HomeStatistic from '@/components/home/home-statistic.vue';
import HomeTradeMark from '@/components/home/home-trade-mark.vue';
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('home.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('home.meta.description'),
    }
  ]
});
</script>