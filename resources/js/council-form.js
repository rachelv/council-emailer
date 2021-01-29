import Vue from 'vue';

new Vue({
    el: '#v-council-form',
    data: {
        fromEmail: '',

        hasValidEmail: false,
        showEmailError: false,

        hasValidSubject: false,
        hasValidMessage: false,
    },
    computed: {
        submitIsDisabled: function() {
            return !(this.hasValidEmail && this.hasValidSubject && this.hasValidMessage);
        }
    },
    methods: {
        isEmailValid: function() {
            if (this.fromEmail.length > 6) {
                if (!this.validateEmail(this.fromEmail)) {
                    this.hasValidEmail = false;
                    this.showEmailError = true;
                    return;
                }
            }
            this.hasValidEmail = true;
            this.showEmailError = false;
        },

        validateEmail: function(email) {
            // straight from the vue form validation documentation
            var regexp = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return regexp.test(email);
        }
    }
});