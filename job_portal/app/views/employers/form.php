<form method="POST" action="/?controller=Admin&action=<?= isset($employer) ? 'update&id=' . $employer['id'] : 'store' ?>">
    <input type="text" name="employer_name" placeholder="Employer Name" value="<?= $employer['employer_name'] ?? '' ?>" required>
    <input type="text" name="company_name" placeholder="Company Name" value="<?= $employer['company_name'] ?? '' ?>" required>
    <input type="text" name="contact_no" placeholder="Contact No" value="<?= $employer['contact_no'] ?? '' ?>" required>
    <input type="text" name="username" placeholder="Username" value="<?= $employer['username'] ?? '' ?>" required>
    <?php if (!isset($employer)): ?>
        <input type="password" name="password" placeholder="Password" required>
    <?php endif; ?>
    <button type="submit">Save</button>
</form>
