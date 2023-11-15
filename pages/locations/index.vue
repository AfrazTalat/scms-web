<template>
  <div>
    <sub-header />
    <location-contain />
  </div>
</template>
<script lang="ts" setup>
import LocationContain from '@/components/loactions/location-contain.vue';
import SubHeader from '@/components/loactions/sub-header.vue';
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('branches.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('branches.meta.description'),
    }
  ]
});
</script>