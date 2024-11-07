<?php if ($books) : ?>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>ISBN</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?php echo $book->id; ?></td>
                    <td><?php echo $book->title; ?></td>
                    <td><?php echo $book->author; ?></td>
                    <td><?php echo $book->genre; ?></td>
                    <td><?php echo $book->isbn; ?></td>
                    <td><button class="edit-book" data-book-id="<?php echo $book->id; ?>">Edit</button></td>
                    <td><button class="delete-book" data-book-id="<?php echo $book->id; ?>">Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No books found.</p>
<?php endif; ?>