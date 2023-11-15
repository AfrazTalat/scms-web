<template>
  <section class="trade-project">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="content">
            <img
              src="@/assets/img/trade_4.png"
              class="trade-logo"
              alt="" />

            <h4>
              بريسوفاك
            </h4>

            <p>
              أجهزة تنظيف مجاري ودكت  التكييف وغسيل المداخن
            </p>

            <div class="flag-contain">
              <img
                src="@/assets/img/germany.svg"
                alt="" />

              <span>
                ايطاليا
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss">
  .trade-project {
    width: 100%;
    position: relative;
    z-index: 9;
    
    .content {
      width: 100%;
      padding: 60px 0px;
      background-color: #fff;
      border: 1px solid rgba($color: #14A1D5, $alpha: 0.06);
      border-radius: 6px;
      box-shadow: 0px 0px 20px rgba($color: #058702, $alpha: 0.06);
      margin-top: -75px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      align-content: center;
      text-align: center;

      .trade-logo {
        width: 170px;
        height: 170px;
        object-fit: contain;
      }

      h4 {
        color: var(--dark);
        font-size: 30px;
        font-weight: 900;
        line-height: 50px;
        margin: 24px 0px 15px 0px;
      }

      p {
        color: #989898;
        font-size: 16px;
        font-weight: 500;
        line-height: 20px;
        margin-bottom: 20px;
      }

      .flag-contain {
        width: 170px;
        height: 45px;
        background-color: rgba($color: #058702, $alpha: 0.03);
        border-radius: 25px;
        border: 1px solid rgba($color: #058702, $alpha: 0.06);
        display: flex;
        align-content: center;
        align-items: center;
        justify-content: center;

        img {
          width: 24px;
          height: 24px;
          object-fit: cover;
          border-radius: 50%;
          margin-inline-end: 9px;
        }

        span {
          color: var(--dark);
          font-size: 16px;
          font-weight: 500;
          line-height: 20px;
        }
      }
    }
  }
</style>