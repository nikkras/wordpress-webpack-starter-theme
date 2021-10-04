/* eslint-disable prefer-const */
/* eslint-disable camelcase */
import debounce from 'lodash.debounce';

export default class FormWizard {
  constructor(prop_currentStepIdx = 0, scrollInstance) {
    this.steps = [...document.querySelectorAll('.regSteps__step')];
    this.formGroups = [...document.querySelectorAll('[class^=um-col-1]')];
    this.formControls = [...document.querySelectorAll('.um-form-field')];
    this.btnPrev = document.querySelector('.btn--prev');
    this.btnNext = document.querySelector('.btn--next');
    this.btnSubmit = document.getElementById('um-submit-btn');
    this.selects = [...document.querySelectorAll('.select2')];
    this.currentStepIdx = prop_currentStepIdx;
    this.scrollInstance = scrollInstance;

    this.init();
  }

  init() {
    this.showStep(this.currentStepIdx);
    this.addEvents();
  }

  showStep(prop_stepIdx = 0) {
    const stepIdx = prop_stepIdx;

    if (this.scrollInstance) {
      const update = debounce(() => {
        this.scrollInstance.update();
      }, 350);
      update();
    }

    this.steps[stepIdx].classList.add('regSteps__step--active');
    this.formGroups[stepIdx].classList.add('is-active');
    this.btnPrev.classList[stepIdx === 0 ? 'remove' : 'add']('btn--visible');
    this.btnNext.classList[stepIdx === 2 ? 'remove' : 'add']('btn--visible');
    this.btnSubmit.classList[stepIdx === 2 ? 'add' : 'remove']('btn--visible');
    document.body.classList.add(`step-${stepIdx}`);
    // this.btnNext.innerText = this.btnNext.dataset[
    //   stepIdx === this.formGroups.length - 1 ? 'finalStepText' : 'stepText'
    // ];
  }

  prevNext(prop_value = 0) {
    const value = prop_value;

    if (value === 1 && !this.validate()) {
      return false;
    }

    if (value === -1) {
      this.steps[this.currentStepIdx].classList.remove(
        'regSteps__step--active'
      );
    }

    this.formGroups[this.currentStepIdx].classList.remove('is-active');

    this.currentStepIdx += value;

    if (this.currentStepIdx >= this.formGroups.length) {
      this.element.submit();
      return false;
    }

    this.showStep(this.currentStepIdx);
  }

  validate() {
    const currentStepRequiredElements = [
      ...this.formGroups[this.currentStepIdx].querySelectorAll(
        '.um-form-field'
      ),
    ];
    let valid = true;

    for (let element of currentStepRequiredElements) {
      if (element.value === null || element.value.trim() === '') {
        // element.closest('.js-input-group').classList.add('has-error');
        element.parentNode.classList.add('has-error');
        valid = false;
      }
    }

    return valid;
  }

  addEvents() {
    this.formControls.forEach((el) => {
      el.addEventListener('keyup', (e) => {
        e.target.parentNode.classList.remove('has-error');
      });
      el.addEventListener('change', (e) => {
        e.target.parentNode.classList.remove('has-error');
      });
    });
    this.selects.forEach((el) => {
      el.addEventListener('click', (e) => {
        e.target.parentNode.parentNode.parentNode.classList.remove('has-error');
      });
    });

    this.btnPrev.addEventListener('click', this.prevNext.bind(this, -1));
    this.btnNext.addEventListener('click', this.prevNext.bind(this, 1));
  }
}
