'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var BP = {};

BP.ContactForm = function () {
  function ContactForm($form) {
    _classCallCheck(this, ContactForm);

    this.$form = document.querySelector($form);
    this.$submit = this.$form.querySelector('.submit');
    this.$fields = this.$form.querySelectorAll('.field');
    this.data = {};
    this.ajax = bp_contact_form_ajax;
    this.disabled = false;

    // Watch form
    this.watch();
  }

  // Watches the form


  _createClass(ContactForm, [{
    key: 'watch',
    value: function watch() {
      var _this = this;

      // Handle form submission
      this.$form.addEventListener('submit', function (e) {
        _this.handleSubmit(e);
      });
    }

    // Handles form submissions

  }, {
    key: 'handleSubmit',
    value: function handleSubmit(e) {

      e.preventDefault();

      // Disable form submission
      this.$submit.disabled = true;

      // Set button state 
      this.$submit.setAttribute('label', this.$submit.innerHTML);
      this.$submit.innerHTML = 'Sending...';

      // TODO: Add validation step
      this.submit();
    }

    // Gets form values

  }, {
    key: 'getFields',
    value: function getFields() {

      var $fields = this.$form.querySelectorAll('.field'),
          fields = {};

      // Store value
      $fields.forEach(function ($field) {

        // TODO: add support for checkboxes and radio
        var $el = $field.querySelector('input,textarea,select'),
            name = $field.getAttribute('name');

        // Store
        var field = fields[name] = {};

        field.name = $field.getAttribute('name');
        field.value = $el.value;
      });

      return fields;
    }

    // Submits the form

  }, {
    key: 'submit',
    value: function submit() {

      var data = {
        fields: this.getFields()
      };

      var self = this;

      axios.post(this.ajax.submitUrl, data).then(function (r) {

        var data = JSON.parse(r.data);

        // Handle successful submission
        if (!data.error) {

          // TODO: Create reset form method
          self.$submit.innerHTML = 'Message sent!';

          setTimeout(function () {
            self.resetForm();
          }, 1000);
        }
      }).catch(function (e) {
        console.log(e);
      });
    }

    // Resets the form

  }, {
    key: 'resetForm',
    value: function resetForm() {

      // Clear all values
      this.$form.querySelectorAll('input,textarea,select').forEach(function ($el) {

        $el.value = null;
      });

      // Enabled submissions
      this.$submit.disabled = null;
    }
  }]);

  return ContactForm;
}();