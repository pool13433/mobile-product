<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="active"><a href="#">Overview</a></li>
        <?php if ($_SESSION['person']['per_status'] != EMPLOYEE_STATUS): ?>
            <li><a href="index.php?page=list-person"><i class="glyphicon glyphicon-user"></i> ผู้ใช้งานในระบบ</a></li>        
        <?php endif; ?>
    </ul>
    <ul class="nav nav-sidebar">
        <?php if ($_SESSION['person']['per_status'] != EMPLOYEE_STATUS): ?>
            <li><a href="index.php?page=list-brand"><i class="glyphicon glyphicon-adjust"></i> รายการ ยี้ห้อเครื่อง</a></li>
            <li><a href="index.php?page=list-model"><i class="glyphicon glyphicon-stats"></i> รายการ รุ่นเครื่อง</a></li>
            <li><a href="index.php?page=list-color"><i class="glyphicon glyphicon-tower"></i> รายการ สีสินค้า</a></li>
            <li><a href="index.php?page=list-product"><i class="glyphicon glyphicon-phone"></i> รายการ สินค้าโทรศัพท์</a></li>
            <li><a href="index.php?page=list-problem"><i class="glyphicon glyphicon-wrench"></i> รายการ ปัญหาการซ่อมทั้งหมด</a></li>
            <li><a href="index.php?page=list-accessory"><i class="glyphicon glyphicon-cutlery"></i> รายการ อุปกรณ์เสริมของมือถือ</a></li>
            <li><a href="">More navigation</a></li>
        <?php endif; ?>
    </ul>
    <ul class="nav nav-sidebar">
        <?php if ($_SESSION['person']['per_status'] != EMPLOYEE_STATUS): ?>
            <li><a href="index.php?page=list-in_repair"><i class="glyphicon glyphicon-wrench"></i> รายการ ใบซ่อมเข้า</a></li>
            <li><a href="index.php?page=list-repair"><i class="glyphicon glyphicon-wrench"></i> จัดการ ซ่อม</a></li>
        <?php else: ?>
            <li><a href="index.php?page=list-repair"><i class="glyphicon glyphicon-wrench"></i> จัดการ ซ่อม</a></li>
            <?php endif; ?>
    </ul>
</div>