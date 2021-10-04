import classes from 'dom-classes';

const onClick = (burger, navWrapper) => {
  return function () {
    if (classes.has(burger, 'burgerMenu--close')) {
      classes.remove(burger, 'burgerMenu--close');
      classes.remove(navWrapper, 'header__navContent--mobileOpen');
    } else {
      classes.add(burger, 'burgerMenu--close');
      classes.add(navWrapper, 'header__navContent--mobileOpen');
    }
  };
};

export const mobileNav = () => {
  const burger = document.querySelector('.burgerMenu');
  const navWrapper = document.querySelector('.header__navContent');
  burger.addEventListener('click', onClick(burger, navWrapper));
  // burger.addEventListener('touchstart', onClick(burger, navWrapper));
};

export const makeButtons = () => {
  const btnIscriviti = document.querySelector(
    '.listMenu__li--iscriviti .navLink'
  );
  const btnAccedi = document.querySelector('.listMenu__li--accedi  .navLink');

  btnIscriviti &&
    btnIscriviti.classList.add('btn', 'btn--red', 'btn--animated');
  btnAccedi && btnAccedi.classList.add('btn', 'btn--ghost', 'btn--animated');
};

export default mobileNav;
