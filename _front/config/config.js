module.exports = {
  entry: {
    app: [
      './assets/sass/app.scss',
      './assets/js/app.js'
    ],
    modules: [
      './assets/js/modules.js'
    ]
  },
  port: 3003,
  html: false,
  assets_url: '/public/assets/dynamic/',
  assets_path: './../public/assets/dynamic/'
  // refresh: ['src/views/**/*.php', 'modules/views/**/*.php']
}
