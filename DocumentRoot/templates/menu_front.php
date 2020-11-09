<?php if (!empty($menu)) { ?>
    <div class="menu">
        <ul>
            <?php foreach ($menu as $item => $item_array) { ?>
                <li><a href="/public/index.php?year=<?php echo $item_array['year'];?>&month=<?php echo $item_array['month'];?>"><?php echo $item_array['title'] ?> (<?php echo $item_array['nb'] ?>)</a></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>