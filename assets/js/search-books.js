(() => {
    window.addEventListener('DOMContentLoaded', () => {
        const searchForm = document.getElementById('search-form');

        searchForm?.addEventListener('submit', event => {
            event.preventDefault();
            
            const searchQuery = document.getElementById('search-input').value;

            fetch(`${ajaxurl}?action=search_books&search=${encodeURIComponent(searchQuery)}`)
                .then(response => response.json())
                .then(data => {
                    updateBookListAfterSearch(data);
                })
                .catch(error => {
                    console.error('Failed to retrieve search results:', error);
                });
        });

        const updateBookListAfterSearch = response => {
            const books = response.data;
            const tableBody = document.querySelector('.wp-list-table tbody');

            tableBody.innerHTML = '';

            books.forEach(book => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${book.id}</td>
                    <td>${book.title}</td>
                    <td>${book.author}</td>
                    <td>${book.genre}</td>
                    <td>${book.isbn}</td>
                    <td><button class="edit-book" data-book-id="${book.id}">Edit</button></td>
                    <td><button class="delete-book" data-book-id="${book.id}">Delete</button></td>
                `;
                tableBody.appendChild(row);
            });
        };
    });
})();
