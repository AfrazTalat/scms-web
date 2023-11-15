<template>
  <nav id="nav" class="navbar w-100" :class="showNav ? 'active-background' : ''">
    <div class="container">
      <div class="content w-100">
        <div class="hamburger" :class="showNav ? 'active' : ''" @click="showNav = !showNav">
          <span class="line" />
          <span class="line" />
          <span class="line" />
        </div>

        <NuxtLink :to="localePath('/')">
          <SharedAppLogo />
        </NuxtLink>

        <ul class="navbar-nav" :class="showNav ? 'active-nav' : ''">
          <li v-for="(nav, i) in navLinks" :key="i" class="nav-item">
            <NuxtLink :to="{ path: localePath(`/${nav.link}`), hash: nav.hash }" class="nav-link">{{ $t(nav.title) }}
            </NuxtLink>
          </li>
        </ul>

        <div class="buttons-contain">
          <a class="language" :href="switchLocalePath($i18n.locale === 'ar' ? 'en' : 'ar')">
            <span>{{ $i18n.locale === 'ar' ? 'en' : 'ar' }}</span>
          </a>

          <NuxtLink :to="localePath('/ec/cart')" class="btn btn-primary">
            <img src="@/assets/img/cart.svg" class="standard-img">

            <span>{{ $t("ecommerce.cart") }} ({{ cart.instance?.count ?? 0 }})</span>

            <img src="@/assets/img/cart.svg" class="hover-img">
          </NuxtLink>
        </div>
      </div>
    </div>
  </nav>
</template>

<script lang="ts" setup>
import { useCart } from '~~/stores/ecommerce/cart';
import { navLinks } from './header-menu'

const cart = useCart();

const localePath = useLocalePath()
const switchLocalePath = useSwitchLocalePath()

const showNav = ref(false);



// const logoSetting = compueted<ISetting>(() => {
//   return useSettingsStore().settings['app_logo'] ?? undefined;
// })

onMounted(() => {
  nextTick(function () {
    window.addEventListener('scroll', function () {
      const navbar = document.getElementById('nav')
      if (!navbar) { return }
      const navClasses = navbar.classList
      if (document.documentElement.scrollTop >= 70) {
        if (navClasses.contains('navscroll') === false) {
          navClasses.toggle('navscroll')
        }
      } else if (navClasses.contains('navscroll') === true) {
        navClasses.toggle('navscroll')
      }
    })
  })
})
</script>

<style lang="scss" scoped>
.navbar {
  // padding: 24px 0px;
  // position: fixed;
  // top: 0;
  // left: 0;
  // z-index: 999;
  transition: all 0.3s linear;

  &::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #004e77;
    top: 0;
    left: 0;
    z-index: -1;
    transition: all 0.3s linear;
  }

  &.active-background {
    background-color: #004e77;
  }

  &.navscroll {
    box-shadow: 0px 0px 10px rgba($color: #058702, $alpha: 0.3);
    padding: 10px 0px !important;

    &::after {
      height: 100%;
    }

    .brand-image {
      height: 80px !important;
    }
  }

  .content {
    display: flex;
    align-content: center;
    align-items: center;
    justify-content: space-between;

    .hamburger {
      display: none;

      .line {
        width: 30px;
        height: 3px;
        background-color: var(--light);
        display: block;
        margin: 8px auto;
        transition: all 0.3s ease-in-out;
      }

      &.active {
        transition: all 0.3s ease-in-out;
        transition-delay: 0.6s;
        transform: rotate(45deg);

        .line {
          &:nth-child(2) {
            width: 0px;
          }

          &:nth-child(3),
          &:nth-child(1) {
            transition-delay: 0.3s;
          }

          &:nth-child(1) {
            transform: translateY(6.5px);
          }

          &:nth-child(3) {
            transform: translateY(-15px) rotate(90deg);
          }
        }
      }
    }

    .brand-image {
      width: 82px;
      height: 91px;
      object-fit: contain;
      transition: all 0.3s linear;
    }

    .navbar-nav {
      flex-direction: row;

      .nav-item {
        margin-inline-end: 24px;

        &:last-child {
          margin: 0px !important;
        }

        .nav-link {
          font-size: 16px;
          font-weight: 700;
          line-height: 19px;
          color: var(--light);
          position: relative;

          &::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            border-radius: 4px;
            background-color: var(--secondary-color);
            bottom: 0;
            left: 0;
            transform: scaleX(0);
            transition: all 0.3s linear;
          }

          &:hover {
            color: var(--secondary-color);

            &::after {
              transform: scaleX(1);
            }
          }
        }
      }
    }

    .language {
      width: 50px;
      height: 50px;
      background-color: var(--secondary-color);
      display: flex;
      align-content: center;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      overflow: hidden;
      position: relative;
      z-index: 4;
      margin-inline-end: 10px;
      text-transform: uppercase;
      border: none;

      &::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: var(--light);
        top: 0;
        left: 0;
        z-index: -1;
        border-radius: 50%;
        transform: scale(0);
        transition: all 0.3s linear;
      }

      span {
        color: var(--light);
        font-size: 16px;
        font-weight: 700;
        line-height: 19px;
      }

      &:hover {
        &::after {
          transform: scale(1);
        }

        span {
          color: var(--secondary-color);
          animation: toRightFromLeft 0.3s linear;
        }
      }
    }
  }
}

@media (max-width: 999px) {
  .navbar {
    .hamburger {
      display: block !important;
    }

    &.navscroll {
      .navbar-nav {
        top: 100px;
      }
    }

    .navbar-nav {
      width: 100%;
      height: 100vh;
      top: 139px;
      right: -100%;
      background-color: #004e77;
      position: absolute;
      flex-direction: column !important;
      justify-content: flex-start;
      padding: 20px 0px;
      transition: all 0.3s linear;

      &.active-nav {
        right: 0px !important;
      }

      li {
        width: 100%;
        text-align: center;
        margin: 0px 0px 20px 0px;
      }
    }

    .btn-primary {
      display: none !important;
    }
  }
}
</style>