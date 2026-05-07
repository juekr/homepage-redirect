import app from 'flarum/forum/app';

app.initializers.add('homepage-redirect', () => {
  if (app.current.get('routeName') === 'index' && app.session.user) {
    window.location.replace(app.route('index') + 'all');
  }
});