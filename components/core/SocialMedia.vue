<template>
  <ul class="socail-media">
    <li class="socail-contain" v-for="(icon, i) in socialIcons" :key="i">
      <a :href="`${icon.value}`" target="_blank" class="socail-link">
        <img :src="`/assets/img/${icon.key}.svg`" alt="" />
      </a>
    </li>
  </ul>
</template>

<script lang="ts" setup>
import { useSettings } from '~/stores/settings';

const { setting } = useSettings();

const socialIcons = computed<{ key: string, value: string }[]>(() => {
  const socialSetting = setting('social_icons')
  if (!socialSetting) return [];
  return typeof socialSetting.value === 'string' ? JSON.parse(socialSetting.value) : socialSetting.value;
})
</script>

<style lang="scss">
.socail-media {
  display: flex;
  align-content: center;
  align-items: center;

  .socail-contain {
    margin-inline-end: 10px;
    height: 36px;

    &:last-child {
      margin: 0px;
    }

    .socail-link {
      width: 35px;
      height: 35px;

      img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        opacity: .4;
      }

      &:hover img {
        opacity: 1;
      }
    }
  }
}
</style>
