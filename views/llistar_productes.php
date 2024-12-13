<ul>
    <?php if (!empty($productes)) : ?>
        <?php foreach ($productes as $producte) : ?>
            <li>
                <h3><?php echo htmlspecialchars($producte['product_id']); ?></h3>
                <p><?php echo htmlspecialchars($producte['product_name']); ?></p>
            </li>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No hay productos para esta categoría.</p>
    <?php endif; ?>
</ul>
