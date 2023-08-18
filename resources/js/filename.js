window.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.input-file input[type=file]').
        addEventListener('change', function () {
            this.nextElementSibling.innerHTML = this.files[0].name
        })
})
