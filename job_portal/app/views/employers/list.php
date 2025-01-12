<form method="GET" action="/?controller=Admin&action=search">
    <input type="text" name="keyword" placeholder="Search employer...">
    <button type="submit">Search</button>
</form>
<a href="/?controller=Admin&action=create">Add Employer</a>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Company</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employers as $employer): ?>
        <tr>
            <td><?= $employer['employer_name'] ?></td>
            <td><?= $employer['company_name'] ?></td>
            <td><?= $employer['contact_no'] ?></td>
            <td>
                <a href="/?controller=Admin&action=edit&id=<?= $employer['id'] ?>">Edit</a>
                <a href="/?controller=Admin&action=delete&id=<?= $employer['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
