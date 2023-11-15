<template>
  <section class="statistic">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-12 mb-4 box-contain" v-for="(box, i) in statistics" :key="i">
          <div class="box">
            <div class="image-content">
              <img :src="`/assets/img/${box.img}.svg`" alt="" />
            </div>

            <div class="content">
              <h4>
                {{ box.number }}+
              </h4>

              <p>
                {{ box.desc }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>

const { t } = useI18n()

const statistics = [
  {
    img: 'statistic_1',
    number: t('common.statistics.statistic1_number'),
    desc: t('common.statistics.statistic1_title')
  }, {
    img: 'statistic_2',
    number: t('common.statistics.statistic2_number'),
    desc: t('common.statistics.statistic2_title')
  }, {
    img: 'statistic_3',
    number: t('common.statistics.statistic3_number'),
    desc: t('common.statistics.statistic3_title')
  }
];
</script>

<style lang="scss">
.statistic {
  width: 100%;
  padding: 90px 0px 80px 0px;
  background-color: #fff !important;

  .box-contain {
    .box {
      width: 100%;
      display: flex;
      align-content: center;
      align-items: center;
      justify-content: space-between;
      transition: all .3s linear;

      .image-content {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;

        img {
          width: 50px;
          height: 50px;
          object-fit: contain;
          transition: all .3s linear;
        }
      }

      .content {
        width: calc(100% - 120px);

        h4 {
          font-size: 50px;
          font-weight: 900;
          line-height: 61px;
          margin-bottom: 6px !important;
        }

        p {
          color: var(--dark);
          font-size: 18px;
          font-weight: 700;
          margin: 0px;
        }
      }

      &:hover {
        transform: translateY(-10px);

        .image-content img {
          animation: toRightFromLeft .4s linear;
        }
      }
    }

    &:first-child .box {
      .image-content {
        background-color: rgba($color: #058702, $alpha: 0.06);
        border: 1px solid rgba($color: #058702, $alpha: 0.10);
      }

      h4 {
        color: var(--primary-color);
      }
    }

    &:nth-child(2) {
      padding: 0px;

      .box {
        .image-content {
          background-color: rgba($color: #14A1D5, $alpha: 0.06);
          border: 1px solid rgba($color: #14A1D5, $alpha: 0.10);
        }

        h4 {
          color: var(--secondary-color);
        }
      }
    }

    &:last-child .box {
      .image-content {
        background-color: rgba($color: #004E77, $alpha: 0.06);
        border: 1px solid rgba($color: #004E77, $alpha: 0.10);
      }

      h4 {
        color: #004E77;
      }
    }
  }
}

@media (max-width: 999px) {
  .statistic .box-contain {
    padding: 0px 10px !important;
  }
}
</style>