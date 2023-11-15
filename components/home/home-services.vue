<template>
  <section class="services general-pattern">
    <div class="container">
      <div class="general-heading">
        <h1>
          {{ $t('services.our_services') }}
        </h1>

        <p>
          {{ $t('services.our_services_subtitle') }}
        </p>

        <img src="@/assets/img/head_icon.svg" alt="" />
      </div>

      <div class="row">
        <div class="col-lg-4 col-12 mb-4 border-shape" v-for="(service, i) in services" :key="i">
          <div class="box">
            <div class="image-content">
              <img :src="`/assets/img/${service.img}.svg`" :alt="`${service.title}`" />
            </div>

            <h4 class="title">
              {{ service.title }}
            </h4>

            <p class="desc">
              {{ service.desc }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>

const { t } = useI18n()

const services = [
  {
    img: 'car-wash',
    title: t('services.service1_title'),
    desc: t('services.service1_description')
  }, {
    img: 'oil-bottle',
    title: t('services.service2_title'),
    desc: t('services.service2_description')
  }, {
    img: 'clean-car',
    title: t('services.service3_title'),
    desc: t('services.service3_description')
  }
];

</script>

<style lang="scss">
.services {
  width: 100%;
  padding: 90px 0px 66px;
  background-color: rgba($color: #14A1D5, $alpha: 0.03);

  .border-shape {
    position: relative;

    &::after {
      content: '';
      position: absolute;
      width: 1px;
      height: 50%;
      top: 25%;
      left: -5px;
      background-color: rgba($color: #14A1D5, $alpha: 0.150);
      z-index: -1;
    }

    &:last-child::after {
      display: none;
    }
  }

  .box {
    width: 100%;
    display: flex;
    align-items: center;
    align-content: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
    transition: all .3s linear;

    .image-content {
      width: 200px;
      height: 200px;
      display: flex;
      align-items: center;
      align-content: center;
      justify-content: center;
      background-color: rgba($color: #14A1D5, $alpha: 0.10);
      border: 1px solid rgba($color: #14A1D5, $alpha: 0.10);
      border-radius: 50%;
      position: relative;
      z-index: 9;

      &::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: var(--light);
        border-radius: 50%;
        top: 0;
        left: 0;
        z-index: -1;
        transition: all .3s linear;
      }

      img {
        width: 50%;
        height: 50%;
        object-fit: contain;
      }
    }

    .title {
      font-size: 22px;
      font-weight: 900;
      line-height: 27px;
      margin: 30px 0px;
    }

    .desc {
      font-size: 16px;
      font-weight: 500;
      line-height: 25px;
      color: #989898;
    }

    &:hover {
      transform: translateY(-10px);

      .image-content::after {
        transform: scale(0);
      }

      .title {
        color: var(--primary-color);
      }
    }
  }
}

@media (max-width: 999px) {
  .services .border-shape::after {
    width: 100%;
    height: 1px;
    bottom: -5px;
    left: 0px;
    top: unset !important;
  }
}
</style>