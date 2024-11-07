(() => {
    window.addEventListener('DOMContentLoaded', () => {
        const editRows = document.querySelectorAll('.edit-book');
        
        editRows.forEach(editRow => {
            editRow.addEventListener('click', event => {
                const bookID = event.target.getAttribute('data-book-id');

                fetch(`${ajaxurl}?action=get_book_details&book_id=${encodeURIComponent(bookID)}`)
                    .then(response => response.json())
                    .then(bookDetails => {
                        if (bookDetails.success) {
                            document.getElementById('edit-book-id').value = bookDetails.data.id;
                            document.getElementById('edit-book-title').value = bookDetails.data.title;
                            document.getElementById('edit-book-author').value = bookDetails.data.author;
                            document.getElementById('edit-book-genre').value = bookDetails.data.genre;
                            document.getElementById('edit-book-isbn').value = bookDetails.data.isbn;

                            const editModal = document.getElementById('edit-book-modal');
                            editModal.style.display = 'block';
                        } else {
                            console.error('Failed to retrieve book details:', bookDetails.data);
                        }
                    })
                    .catch(error => {
                        console.error('AJAX request failed:', error);
                    });
            });
        });

        const editForm = document.getElementById('edit-book-form');

        editForm?.addEventListener('submit', event => {
            event.preventDefault();

            const formData = new FormData(editForm);
            formData.append('action', 'update_book');
            formData.append('edit_book', 'book_id');

            fetch(ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Book updated successfully:', data.data);

                    const notice = document.createElement('div');
                    notice.className = 'notice notice-success is-dismissible';
                    notice.innerHTML = '<p>Book updated successfully.</p>';
                    document.querySelector('.wrap').prepend(notice);

                    setTimeout(() => {
                        location.reload();
                    }, 200);
                } else {
                    console.error('Error updating book:', data.data);

                    const notice = document.createElement('div');
                    notice.className = 'notice notice-error is-dismissible';
                    notice.innerHTML = '<p>Error updating book. Please try again later.</p>';
                    document.querySelector('.wrap').prepend(notice);
                }
            })
            .catch(error => {
                console.error('AJAX request failed:', error);

                const notice = document.createElement('div');
                notice.className = 'notice notice-error is-dismissible';
                notice.innerHTML = '<p>Request failed. Please try again later.</p>';
                document.querySelector('.wrap').prepend(notice);
            });
        });
    });
})();
