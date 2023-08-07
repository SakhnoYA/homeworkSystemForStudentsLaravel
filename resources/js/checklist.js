const lists = document.querySelectorAll('.dropdown-check-list');

lists.forEach(function (list) {
    const anchor = list.querySelector('.anchor');

    anchor.addEventListener('click', function () {
        list.classList.toggle('visible');
    });
});
