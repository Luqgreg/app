<?php $wid = $resultSet->getHeader( 'wid' ) ?>
<? if (! empty( $wid ) ): ?>
<div class="result-top-articles">
    <ul>
    <? foreach ( $resultSet->getTopPages() as $articleId ): ?>
        <?php $title = GlobalTitle::newFromID( $articleId, $wid ); ?>
        <? if ( $title ): ?>
        <li>
            <a href="<?=$title->getFullUrl()?>"><?=$title->getText()?></a>
        </li>
        <? endif; ?>
    <? endforeach; ?>
    </ul>
</div>
<? endif; ?>
