import Vue from 'vue';

new Vue({
    el: '#v-council-form',
    data: {
        fromEmail: '',
        hasValidEmail: false,
        showEmailError: false,

        exampleSubjects: [],
        subject: '',
        subjectIdx: 0,
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
            /*
            if (this.fromEmail.length > 6 && !this.validateEmail(this.fromEmail)) {

            } else if () {

            }
            */
        },

        updateSubject: function() {
            this.subjectIdx += 1;
            if (this.subjectIdx == this.exampleSubjects.length) {
                this.subjectIdx = 0;
            }

            this.subject = this.exampleSubjects[this.subjectIdx];
        },

        initializeSubjects: function(exampleSubjects) {
            // this seems to get called on every dom interaction
            // clearly this is not the best way to do this but not sure of another way without making this a component
            if (this.exampleSubjects.length == 0) {
                this.exampleSubjects =  exampleSubjects;

                // initialize a random subject and save the index of that subject so we can cycle through later
                this.subjectIdx = Math.floor(Math.random() * this.exampleSubjects.length);
                this.subject = this.exampleSubjects[this.subjectIdx];
            }
        },

        validateEmail: function(email) {
            // straight from the vue form validation documentation
            var regexp = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return regexp.test(email);
        }
    }
});