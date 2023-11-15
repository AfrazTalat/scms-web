<template>
  <div>
    <ContactSubHeader />
    <ContactForm />
  </div>
</template>
<script lang="ts" setup>
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('contact.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('contact.meta.description'),
    }
  ]
});
</script>