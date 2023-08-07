// window.addEventListener('DOMContentLoaded', () => {
//     const forms = document.querySelectorAll('form.login__form');
//
//     forms.forEach((form) => {
//         form.addEventListener('submit', () => {
//             collectAllFormData(forms);
//         });
//     });
// });
//
// function collectAllFormData(forms)
// {
//     const formDatas = new FormData();
//     forms.forEach((form, index) => {
//         const formData = new FormData(form);
//         for (const [name, value] of formData.entries()) {
//             formDatas.append(`form${index}[${name}]`, value);
//         }
//     })
//
//     const xhr = new XMLHttpRequest();
//     xhr.open('POST', '/php/common/saveFormsData.php', true);
//
//     xhr.send(formDatas);
//
// }
//
