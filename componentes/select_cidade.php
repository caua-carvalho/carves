<select class="form-select" id="cidade" name="cidade">
    <?php
    $sql = "SELECT cidade FROM imoveis WHERE 1=1";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['cidade'] . "'>" . $row['cidade'] . "</option>";
        }
    } else {
        echo "<option value=''>Nenhuma cidade cadastrada...</option>";
    }
    ?>
</select>