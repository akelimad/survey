module.exports = {
  entry: {
    /* plugins: [
      './public/assets/sass/plugins.scss',
      './public/assets/js/plugins.js'
    ], */
    app: [
      './public/assets/sass/app.scss',
      './public/assets/js/app.js'
    ]
  },
  port: 3003,
  html: false,
  assets_url: '/public/build/',  // Urls dans le fichier final
  assets_path: './public/build/', // ou build ?
  refresh: ['src/**/*.php', 'modules/**/*.php'] // Permet de forcer le rafraichissement du navigateur lors de la modification de ces fichiers
}
