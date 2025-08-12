document.addEventListener('DOMContentLoaded', function () {
  const toggleButton = document.getElementById('toggleButton');
  const sidebar = document.getElementById('sidebar');
  const main = document.getElementById('main');

  toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('d-none');
    main.classList.toggle('col-md-9');
    main.classList.toggle('col-lg-10');
    main.classList.toggle('col-md-12');
    main.classList.toggle('col-lg-12');
  });
});
