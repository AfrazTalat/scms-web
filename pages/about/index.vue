<template>
  <div>
    <sub-header />
    <about-contain />
    <home-statistic />
  </div>
</template>

<script lang="ts" setup>
import AboutContain from '@/components/about/about-contain.vue'
import SubHeader from '@/components/about/sub-header.vue'
import HomeStatistic from '@/components/home/home-statistic.vue'
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('about.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('about.meta.description'),
    }
  ]
});

</script>

<style scoped>
</style>