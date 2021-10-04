import Swiper, { Navigation, Parallax, Autoplay } from 'swiper';
import gsap from 'gsap';

Swiper.use([Navigation, Parallax, Autoplay]);

export const landingHeroSwiper = () => {
  const introSlider = document.querySelector('.heroSlider');
  // eslint-disable-next-line no-new
  new Swiper(introSlider, {
    loop: true,
    init: true,
    parallax: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    autoplay: {
      delay: 5000,
    },
    // watchOverflow: true,
    effect: 'slide',
    // fadeEffect: {
    //   crossFade: true,
    // },
    allowTouchMove: false,
    speed: 1200,
  });
};

export const textRotator = () => {
  const textRotatorUl = document.querySelector('.textRotatorUl');
  const textRotatorLi = [...document.querySelectorAll('.textRotatorLi')];

  let textHeight;
  // const delay = 2500;

  // let index = 1;

  if (textRotatorLi.length > 1) {
    const tl = gsap.timeline({ repeat: -1, repeatDelay: 0 });
    const lastLiCloned = textRotatorLi[0].cloneNode(true);
    const newLength = textRotatorLi.length + 1;
    textRotatorUl.appendChild(lastLiCloned);
    textHeight = textRotatorLi[0].getBoundingClientRect().height;

    function startTl() {
      tl.clear();
      for (let index = 0; index < newLength; index++) {
        // const element = textRotatorLi[index];
        tl.to(textRotatorUl, 0.3, {
          top: -textHeight * (index % newLength),
          delay: index === 0 ? 0 : 2,
        });
      }
    }

    startTl();

    window.addEventListener('resize', () => {
      textHeight = textRotatorLi[0].getBoundingClientRect().height;
      textRotatorUl.style.top = 0;
      startTl();
    });
    // setInterval(() => {
    //   for (let i = 0; i < textListLi.length; i++) {
    //     const ticker = textListLi[i];
    //     ticker.style.marginTop =
    //       -ticker.clientHeight * (index % ticker.length) + 'px';
    //   }
    //   index++;
    // }, delay);
  }
};
