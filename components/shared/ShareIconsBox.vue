<template>
  <ClientOnly>
    <ul class="share-list">
      <li>{{ label ?? $t('common.share') }}</li>

      <li>
        <ShareNetwork network="facebook" :url="shareUrl" :title="shareTitle">
          <img src="/assets/img/share_1.svg" />
        </ShareNetwork>
      </li>

      <li>
        <ShareNetwork network="facebook" :url="shareUrl" :title="shareTitle">
          <img src="/assets/img/share_2.svg" />
        </ShareNetwork>
      </li>

      <li>
        <ShareNetwork network="facebook" :url="shareUrl" :title="shareTitle">
          <img src="/assets/img/share_3.svg" />
        </ShareNetwork>
      </li>

      <li>
        <ShareNetwork network="facebook" :url="shareUrl" :title="shareTitle">
          <img src="/assets/img/share_4.svg" />
        </ShareNetwork>
      </li>

      <li>
        <ShareNetwork network="facebook" :url="shareUrl" :title="shareTitle">
          <img src="/assets/img/share_5.svg" />
        </ShareNetwork>
      </li>

      <li>
        <ShareNetwork network="facebook" :url="shareUrl" :title="shareTitle">
          <img src="/assets/img/share_6.svg" />
        </ShareNetwork>
      </li>

      <li>
        <ShareNetwork network="facebook" :url="shareUrl" :title="shareTitle">
          <img src="/assets/img/share_7.svg" />
        </ShareNetwork>
      </li>

      <li>
        <ShareNetwork network="facebook" :url="shareUrl" :title="shareTitle">
          <img src="/assets/img/share_8.svg" />
        </ShareNetwork>
      </li>

      <li>
        <ShareNetwork network="facebook" :url="shareUrl" :title="shareTitle">
          <img src="/assets/img/share_9.svg" />
        </ShareNetwork>
      </li>
    </ul>
  </ClientOnly>
</template>

<script lang="ts" setup>

const props = defineProps<{
  label?: string,
  url?: string,
  title?: string
}>()

const route = useRoute();
const config = useRuntimeConfig();

const shareUrl = computed(() => {
  return props.url ? props.url : `${config.public.appUrl}${route.fullPath}`;
})

const shareTitle = computed(() => {
  return props.title ? props.title : props.title ?? '';
})
</script>

<style scoped lang="scss">
.share-list {
  width: 100%;
  display: flex;
  align-items: center;
  align-content: center;
  justify-content: center;

  li {
    margin-inline-end: 10px;
    color: #000;
    font-size: 20px;
    font-weight: 700;
    line-height: 25px;

    a {
      img {
        width: 45px;
        height: 45px;
        object-fit: contain;
        border-radius: 50%;
        transition: all 0.3s linear;
      }

      &:hover img {
        transform: translateY(-10px);
      }
    }

    &:first-child {
      margin-inline-end: 30px !important;
    }

    &:last-child {
      margin: 0px !important;
    }
  }
}
</style>