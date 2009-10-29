<?php
if (count($data)) {
?>
	<ul id="myhome-user-contributions" class="activityfeed reset">
<?php
	foreach($data as $row) {
?>
		<li class="activity-type-<?= UserContributionsRenderer::getIconType($row) ?>">
			<img src="<?= $assets['blank'] ?>" class="sprite"<?= UserContributionsRenderer::getIconAltText($row) ?>/>
			<a href="<?= htmlspecialchars($row['url']) ?>" class="title" rel="nofollow"><?= htmlspecialchars($row['title'])  ?></a>
			<cite><?= FeedRenderer::formatTimestamp($row['timestamp']); ?></cite>
			<?= FeedRenderer::getDiffLink($row) ?>

		</li>
<?php
	}
?>
	</ul>
<?php
} else {
	echo wfMsgExt('myhome-user-contributions-empty', array('parse'));
}
