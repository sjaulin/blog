<?php if (!empty($menu)) { ?>
    <h4 class="font-italic">Articles</h4>
    <ul class="nav flex-column">
        <?php foreach ($menu as $item => $item_array) { ?>
            <li class="nav-item"><a class="nav-link" href="/index.php?year=<?php echo $item_array['year']; ?>&month=<?php echo $item_array['month']; ?>"><?php echo $item_array['title'] ?> (<?php echo $item_array['nb'] ?>)</a></li>
        <?php } ?>
    </ul>
<?php } ?>
<h4 class="font-italic">Restons en contact</h4>
<ul class="nav flex-column">
<li class="nav-item"><a class="nav-link" href="/index.php?route=contact"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mail</a></li>
<li class="nav-item"><a class="nav-link" href="https://www.facebook.com/stephane.jaulin" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
<li class="nav-item"><a class="nav-link" href="https://www.linkedin.com/in/sjaulin/" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i> Linkedin</a></li>
</ul>