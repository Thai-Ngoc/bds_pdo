<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the id exists, for example update.php?id=1 will get the one with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $area = isset($_POST['area']) ? $_POST['area'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $direction = isset($_POST['direction']) ? $_POST['direction'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $active = isset($_POST['active']) ? $_POST['active'] : '';
        $image = isset($_POST['image']) ? $_POST['image'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE contacts SET id = ?, title = ?, description = ?, area = ?, price = ?, direction = ?, status = ?, active = ?, image = ? WHERE id = ?');
        $stmt->execute([$id, $title, $description, $area, $price, $direction, $status, $active, $image, $_GET['id']]);
        $msg = 'Cập nhật thành công!';
    }
    // Get the real estate's info from the table
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Không tồn tại');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
    <h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="title">Tiêu đề</label>
        <label for="description">Mô tả</label>
        <input type="text" name="title" value="<?=$contact['title']?>" id="title">
        <input type="text" name="description" id="description" value="<?=$contact['description']?>">

        <label for="area">Diện tích</label>
        <label for="price">Giá</label>
        <input type="number" name="area" value="<?=$contact['area']?>" id="area">
        <input type="number" name="price" value="<?=$contact['price']?>" id="price">

        <label for="direction">Hướng</label>
        <label for="status">Trạng thái</label>
        <input type="text" name="direction" value="<?=$contact['title']?>" id="direction">
        <input type="text" name="status" value="<?=$contact['title']?>" id="status">

        <label for="active">Active</label>
        <label for="image">Hình ảnh</label>
        <input type="text" name="active" value="<?=$contact['title']?>" id="active">
        <input type="text" name="image" value="<?=$contact['title']?>" id="image">

        <input type="submit" value="Cập nhật">
    </form>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
