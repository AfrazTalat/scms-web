<template>
  <div>
    <SharedSubHeader :title="t('downloads.page_title')" />
    <DownloadsList />
  </div>
</template>
<script lang="ts" setup>
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('downloads.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('downloads.meta.description'),
    }
  ]
});

</script>