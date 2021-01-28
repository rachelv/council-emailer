class FormValidator {

    constructor(formEl) {
        this.formEl = formEl;
        this.emailEl = formEl.querySelector("[data-element='email-el']");
        this.subjectEl = formEl.querySelector("[data-element='subject-el']");
        this.buttonEl = formEl.querySelector("[data-element='button-el']");
    
        this.emailEl.addEventListener('keyup', () => this.validateEmail());
    }

    validateEmail() {
        console.log('email');
    }
    enableButton() {
        this.buttonEl.disabled = false;
    }
}

var formValidator = new FormValidator(document.querySelector("[data-component='form-validator']"));
