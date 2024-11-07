(() => {
    window.addEventListener('DOMContentLoaded', () => {
        const deleteBtns = document.querySelectorAll('.delete-book');

        deleteBtns.forEach(deleteBtn => {
            deleteBtn.addEventListener('click', event => {
                const bookID = event.target.getAttribute('data-book-id');
                
                fetch(ajaxurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        action: 'delete_book',
                        book_id: bookID
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Book deleted successfully:', data.data);

                        const notice = document.createElement('div');
                        notice.className = 'notice notice-success is-dismissible';
                        notice.innerHTML = '<p>Book deleted successfully.</p>';
                        document.querySelector('.wrap').prepend(notice);

                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        console.error('Error deleting book:', data.data);

                        const notice = document.createElement('div');
                        notice.className = 'notice notice-error is-dismissible';
                        notice.innerHTML = '<p>Error deleting book. Please try again later.</p>';
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
    });
})();
