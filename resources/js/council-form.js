import Vue from 'vue';

new Vue({
    el: '#v-council-form',
    data: {
        fromName: '',
        fromEmail: '',
        hasValidEmail: false,
        showEmailError: false,

        exampleSubjects: [],
        subject: '',
        subjectIdx: 0,
    },
    computed: {
        submitIsEnabled: function() {
            return this.hasValidEmail && this.fromName.length > 0 && this.subject.length > 0;
        }
    },
    methods: {
        isEmailValid: function() {
            if (this.fromEmail.length > 6 && !this.validateEmail(this.fromEmail) ||
                this.fromEmail.length <=6 && this.showEmailError) {
                this.hasValidEmail = false;
                this.showEmailError = true;
            } else {
                this.hasValidEmail = true;
                this.showEmailError = false;
            }
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