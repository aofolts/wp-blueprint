
const BP = {};

BP.ContactForm = class ContactForm {

  constructor($form) {

    this.$form     = document.querySelector($form)
    this.$submit   = this.$form.querySelector('.submit')
    this.$fields   = this.$form.querySelectorAll('.field')
    this.data      = {}
    this.ajax      = bp_contact_form_ajax
    this.disabled  = false

    // Watch form
    this.watch()

  }

  // Watches the form
  watch() {

    // Handle form submission
    this.$form.addEventListener('submit',e => {
      this.handleSubmit(e)
    });

  }

  // Handles form submissions
  handleSubmit(e) {

    e.preventDefault();

    // Disable form submission
    this.$submit.disabled = true

    // Set button state 
    this.$submit.setAttribute('label',this.$submit.innerHTML)
    this.$submit.innerHTML = 'Sending...'

    // TODO: Add validation step
    this.submit();

  }

  // Gets form values
  getFields() {

    const $fields = this.$form.querySelectorAll('.field'),
          fields  = {};

    // Store value
    $fields.forEach($field => {

      // TODO: add support for checkboxes and radio
      const $el   = $field.querySelector('input,textarea,select'),
            name  = $field.getAttribute('name');

      // Store
      const field = fields[name] = {};

      field.name  = $field.getAttribute('name');
      field.value = $el.value;

    });

    return fields;

  }

  // Submits the form
  submit() {

    const data = {
      fields: this.getFields()
    }

    const self = this

    axios.post(this.ajax.submitUrl,data)

      .then(r => {

        const data = JSON.parse(r.data)

        // Handle successful submission
        if (!data.error) {

          // TODO: Create reset form method
          self.$submit.innerHTML = 'Message sent!'

          setTimeout(() => {
            self.resetForm()
          },1000)

        }

      })
      .catch(e => {
        console.log(e)
      })

  }

  // Resets the form
  resetForm() {

    // Clear all values
    this.$form.querySelectorAll('input,textarea,select').forEach($el => {

      $el.value = null

    })

    // Enabled submissions
    this.$submit.disabled = null

  }

}
