<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $area = isset($_POST['area']) ? $_POST['area'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $direction = isset($_POST['direction']) ? $_POST['direction'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $active = isset($_POST['active']) ? $_POST['active'] : '';
    $image = isset($_POST['image']) ? $_POST['image'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO contacts VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $title, $description, $area, $price, $direction, $status, $active, $image]);
    // Output message
    $msg = 'Khởi tạo thành công!';
}
?>

<?=template_header('Create')?>

<div class="content update">
    <h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="title">Tiêu đề</label>
        <label for="description">Mô tả</label>
        <input type="text" name="title" id="title">
        <input type="text" name="description" id="description">

        <label for="area">Diện tích</label>
        <label for="price">Giá</label>
        <input type="float" name="area" id="area">
        <input type="float" name="price" id="price">

        <label for="direction">Hướng</label>
        <label for="status">Trạng thái</label>
        <input type="text" id="direction">
        <input type="text" name="status" id="status">

        <label for="active">Active</label>
        <label for="image">Hình ảnh</label>
        <input type="text" name="active" id="active">
        <input type="text" name="image" id="image">

        <input type="submit" value="Khởi tạo">

    </form>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>

