<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="active"><a href="#"><i class="glyphicon glyphicon-list-alt"></i> เมนูการใช้งาน</a></li>
        <?php if ($_SESSION['person']['per_status'] != REPAIRMAN_STATUS && $_SESSION['person']['per_status'] != CUSTOMER_STATUS): ?>
            <li><a href="index.php?page=list-person"><i class="glyphicon glyphicon-user"></i> ผู้ใช้งานในระบบ</a></li>        
            <li><a href="index.php?page=list-prefix"><i class="glyphicon glyphicon-check"></i> คำนำหน้าชื่อ</a></li>  
        <?php endif; ?>
    </ul>
    <?php if ($_SESSION['person']['per_status'] != REPAIRMAN_STATUS && $_SESSION['person']['per_status'] != CUSTOMER_STATUS): ?>
        <ul class="nav nav-sidebar">
            <li><a href="index.php?page=list-brand"><i class="glyphicon glyphicon-adjust"></i> รายการ ยี้ห้อเครื่อง</a></li>
            <li><a href="index.php?page=list-model"><i class="glyphicon glyphicon-stats"></i> รายการ รุ่นเครื่อง</a></li>
            <li><a href="index.php?page=list-color"><i class="glyphicon glyphicon-tower"></i> รายการ สีสินค้า</a></li>
            <li><a href="index.php?page=list-product"><i class="glyphicon glyphicon-phone"></i> รายการ สินค้าโทรศัพท์</a></li>
            <li><a href="index.php?page=list-problem"><i class="glyphicon glyphicon-wrench"></i> รายการ ปัญหาการซ่อมทั้งหมด</a></li>
            <li><a href="index.php?page=list-accessory"><i class="glyphicon glyphicon-cutlery"></i> รายการ อุปกรณ์เสริมของมือถือ</a></li>            
        </ul>
    <?php endif; ?>
    <ul class="nav nav-sidebar">
        <?php if ($_SESSION['person']['per_status'] == REPAIRMAN_STATUS) { ?>            
            <li><a href="index.php?page=list-repair"><i class="glyphicon glyphicon-wrench"></i> จัดการ ซ่อม</a></li>
        <?php } else if ($_SESSION['person']['per_status'] == CUSTOMER_STATUS) { ?>
            <li><a href="index.php?page=list-repair"><i class="glyphicon glyphicon-wrench"></i> จัดการ ซ่อม</a></li>            
        <?php } else { ?>
            <li><a href="index.php?page=list-repair_in"><i class="glyphicon glyphicon-arrow-down"></i> รายการ ใบซ่อมเข้า</a></li>
            <li><a href="index.php?page=list-repair"><i class="glyphicon glyphicon-wrench"></i> จัดการ ซ่อม</a></li>
            <li><a href="index.php?page=list-repair_finish"><i class="glyphicon glyphicon-ok-circle"></i> รายการ ซ่อมเสร็จสิ้น</a></li>
        <?php } ?>
    </ul>
    <ul class="nav nav-sidebar">
        <li><a href="index.php?page=report-1"><i class="glyphicon glyphicon-book"></i> รายงานยอดซ่อม</a></li>
        <li><a href="index.php?page=report-2"><i class="glyphicon glyphicon-book"></i> รายงานการซ่อมตามช่าง</a></li>
        <li><a href="index.php?page=report-3"><i class="glyphicon glyphicon-book"></i> รายงานปัญหาที่พบในการซ่อม</a></li>
    </ul>
</div>