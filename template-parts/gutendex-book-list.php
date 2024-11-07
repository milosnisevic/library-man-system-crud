<div class="wrap">
    <h2>Books from Gutendex</h2>
    <?php if ($books && !empty($books['results'])) : ?>
        <div class="pagination">
            <?php if (isset($books['previous'])) : ?>
                <a href="?page=library-management-system-fetch-books&paged=<?php echo $currentPage - 1; ?>" class="button prev-page">Previous</a>
            <?php endif; ?>

            <?php if (isset($books['next'])) : ?>
                <a href="?page=library-management-system-fetch-books&paged=<?php echo $currentPage + 1; ?>" class="button next-page">Next</a>
            <?php endif; ?>
        </div>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Language</th>
                    <th>ISBN</th>
                    <th>Media Type</th>
                    <th>Download Count</th>
                    <th>Subjects</th>
                    <th>Bookshelves</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books['results'] as $book) : ?>
                    <tr>
                        <td><?php echo esc_html($book['title']); ?></td>
                        <td><?php echo esc_html(implode(', ', array_column($book['authors'], 'name'))); ?></td>
                        <td><?php echo esc_html(implode(', ', $book['languages']));; ?></td>
                        <td><?php echo esc_html($book['id']); ?></td>
                        <td><?php echo esc_html($book['media_type']); ?></td>
                        <td><?php echo esc_html($book['download_count']); ?></td>
                        <td><?php echo esc_html(implode(', ', $book['subjects'])); ?></td>
                        <td><?php echo esc_html(implode(', ', $book['bookshelves'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No books found.</p>
    <?php endif; ?>
</div>
