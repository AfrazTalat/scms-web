<template>
  <section class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="content">
            <h4 class="title">
              {{ title }}
            </h4>

            <ul class="list">
              <li>
                <NuxtLink :to="localePath('/')" class="link">
                  {{ $t('common.home') }}
                </NuxtLink>
              </li>
              <li v-for="link in links">
                <NuxtLink :to="localePath(link.link)" class="link">
                  {{ link.label }}
                </NuxtLink>
              </li>

              <li>
                <span class="data">
                  {{ title }}
                </span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>

const props = defineProps<{
  title: string,
  links?: {
    label: string,
    link: string,
  }[]
}>();

const localePath = useLocalePath();
</script>