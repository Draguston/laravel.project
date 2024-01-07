function sendRequest(form, element, text) {
    // Получение данных из формы
    let formData = new FormData(form);
    console.log(element);
    console.log(form);
    console.log(formData);
    console.log(text);

    if (text) {
        for (const value of text) {
            console.log(value);
            if (formData.get(value) === '') {
                alert('Пожалуйста, заполните поле');
                throw new Error('Заполните поле');
            }
        };
    }

    // Создание объекта XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Настройка запроса
    xhr.open("POST", "index.php", true);

    // Отправка данных формы
    xhr.send(formData);

    
    // Обработка события загрузки
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Обработка успешного ответа от сервера
            document.getElementById(element).innerHTML = xhr.response; //заменяем форму на ответ сервера  
        } else {
            // Обработка ошибки AJAX-запроса
            console.log(xhr.status + ": " + xhr.statusText);
        }
    };
}
