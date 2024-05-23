function applyPhoneMask() {
    [].forEach.call( document.querySelectorAll('.form-input-tel'), function(input) {
      var keyCode;
      function mask(event) {
        event.keyCode && (keyCode = event.keyCode);
        var pos = this.selectionStart;
        if (pos < 3) event.preventDefault();
        var matrix = "+7 (___) ___ ____",
            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = this.value.replace(/\D/g, ""),
            new_value = matrix.replace(/[_\d]/g, function(a) {
                return i < val.length ? val.charAt(i++) : a
            });
        i = new_value.indexOf("_");
        if (i != -1) {
            i < 5 && (i = 3);
            new_value = new_value.slice(0, i)
        }
        var reg = matrix.substr(0, this.value.length).replace(/_+/g,
            function(a) {
                return "\\d{1," + a.length + "}"
            }).replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) {
          this.value = new_value;
        }
        if (event.type == "blur" && this.value.length < 5) {
          this.value = "";
        }
      }
  
      input.addEventListener("input", mask, false);
      input.addEventListener("focus", mask, false);
      input.addEventListener("blur", mask, false);
      input.addEventListener("keydown", mask, false);
  
    });
  }
  
  window.addEventListener("DOMContentLoaded", applyPhoneMask);
  
  function processForm(event) {
    event.preventDefault(); // Предотвращаем отправку формы
  
    var name = document.getElementById("name").value.trim();
    var phone = document.getElementById("phone").value.trim();
  
    // Проверка на заполнение обязательных полей
    if (name === "" || phone === "") {
        alert("Пожалуйста, заполните все обязательные поля.");
        return false;
    }
  
    if (phone.replace(/\D/g, "").length !== 11) {
        alert("Пожалуйста, введите телефонный номер в правильном формате: +7(___) ___ ____");
        return false; // Отменяем отправку формы
    }
  
    // Если все данные введены правильно, сохраняем заявку в localStorage
    var request = {
        name: name,
        phone: phone
    };
    var requests = JSON.parse(localStorage.getItem("requests")) || [];
    requests.push(request);
    localStorage.setItem("requests", JSON.stringify(requests));
  
    alert("Заявка успешно сохранена!");
  
    // Очистка полей формы
    document.getElementById("name").value = "";
    document.getElementById("phone").value = "";
  
    // Перерисовываем список заявок
    displayRequests();
  
    return false; // Предотвращаем отправку формы
  }
  
  // Добавляем обработчик события submit формы
  document.getElementById("requestForm").addEventListener("submit", processForm);
  
  // Функция для отображения заявок из localStorage
  function displayRequests() {
    var requests = JSON.parse(localStorage.getItem("requests")) || [];
    var list = document.getElementById("requestList");
  
    // Очищаем список перед добавлением заявок
    list.innerHTML = "";
  
    // Перебираем все заявки и добавляем их в список
    requests.forEach(function(request) {
        var listItem = document.createElement("li");
        listItem.textContent = "Имя: " + request.name + ", Телефон: " + request.phone;
        list.appendChild(listItem);
    });
  }
  
  // Первоначальное отображение заявок при загрузке страницы
  displayRequests();
  
