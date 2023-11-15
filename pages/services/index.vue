<template>
  <div>
    <sub-header />
    <home-services />
    <home-statistic />
  </div>
</template>

<script lang="ts" setup>
import HomeServices from '@/components/home/home-services.vue';
import HomeStatistic from '@/components/home/home-statistic.vue';
import SubHeader from '@/components/services/sub-header.vue';
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('services.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('services.meta.description'),
    }
  ]
});
</script>