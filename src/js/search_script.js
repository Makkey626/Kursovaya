document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('search-button');
    const searchInput = document.getElementById('search_input');

    searchButton.addEventListener('click', function(event) {
        event.preventDefault(); // Предотвращаем переход по ссылке
        if (searchInput.classList.contains('active')) {
            searchInput.classList.remove('active'); // Скрываем строку поиска
            setTimeout(function() {
                searchInput.style.display = 'none'; // Через 0.5 сек скрываем элемент, чтобы он исчезал плавно
            }, 500);
        } else {
            searchInput.style.display = 'block'; // Показываем строку поиска перед анимацией
            setTimeout(function() {
                searchInput.classList.add('active'); // Запускаем анимацию
            }, 10); // Небольшая задержка для срабатывания перехода
        }
    });
});