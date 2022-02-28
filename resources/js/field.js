Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-notes-field', require('./components/IndexField').default)
  Vue.component('detail-nova-notes-field', require('./components/DetailField').default)
  Vue.component('form-nova-notes-field', require('./components/FormField').default)
})
