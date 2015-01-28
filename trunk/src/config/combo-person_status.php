<select class="form-control validate[required]" 
        data-errormessage-value-missing="กรุณากรอก สถานะผู้ใช้งาน"
        name="combo-status" id="combo-status">
    <option value="">-- เลือก -- </option>
    <?php $listPerson = listPersonStatus(); ?>
    <?php foreach ($listPerson as $key => $data): ?>
        <?php if ($status == $key): ?>
            <option value="<?= $key ?>" selected><?= $data ?></option>
        <?php else: ?>
            <option value="<?= $key ?>"><?= $data ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

