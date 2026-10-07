document.querySelectorAll('.archive-form').forEach((form) => {
  form.addEventListener('submit', (event) => {
    if (!window.confirm('Archive this task? It will disappear from the public lists.')) {
      event.preventDefault();
    }
  });
});
