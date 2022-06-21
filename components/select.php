<select class="select selectStyle" multiple name="selectElements[]" style="width: 100%">
    <?php foreach ($allOptions as $option) : ?>
        <option value="<?= $option->optionId ?>" <?php if (isset($optionsBien)) : ?><?php foreach ($optionsBien as $optionBien) : ?> <?php if ($optionBien->optionId === $option->optionId) : ?>selected <?php endif ?> <?php endforeach ?><?php endif ?>><?= $option->optionNom ?>
        </option>
    <?php endforeach ?>
</select>