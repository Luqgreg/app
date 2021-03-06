<section class="Search all-wikia WikiaGrid clearfix search-tracking">
	<div class="results-wrapper">
		<?php if (!empty($results)): ?>
			<?php if ($resultsFound > 0): ?>

				<p class="result-count subtle">
					<?php if (empty($isOneResultsPageOnly)): ?>
						<?= wfMessage('wikiasearch2-results-count', $resultsFoundTruncated, '<strong>' . $query . '</strong>')->text(); ?>
					<?php else: ?>
						<?= wfMsg('wikiasearch2-results-for', '<strong>' . $query . '</strong>'); ?>
					<?php endif; ?>
					<?php if (isset($hub) && $hub) : ?>
						<?= wfMessage( 'wikiasearch2-onhub', Sanitizer::stripAllTags( $hub ) )->escaped() ?>
						|
						<a
							href="<?= preg_replace('/&hub=[^&]+/', '', $_SERVER['REQUEST_URI']) ?>"><?= wfMsg('wikiasearch2-search-all-wikia') ?></a>
					<?php endif ?>
				</p>

				<? if ($results->getQuery() && $query != $results->getQuery()) : ?>
					<p><?= wfMsg('wikiasearch2-spellcheck', $query, $results->getQuery()) ?></p>
				<? endif; ?>

				<ul class="Results inter-wiki">
					<?
					$pos = 0;
					foreach ($results as $result) {
						$pos++;
						echo $app->getView('WikiaSearch', 'CrossWiki_result',
							\Wikia\Search\Result\ResultHelper::extendResult(
								$result,
								$pos + (($currentPage - 1) * $resultsPerPage),
								\Wikia\Search\Result\ResultHelper::MAX_WORD_COUNT_XWIKI_RESULT,
								[
									'width' => WikiaSearchController::CROSS_WIKI_PROMO_THUMBNAIL_WIDTH,
									'height' => WikiaSearchController::CROSS_WIKI_PROMO_THUMBNAIL_HEIGHT
								]
							)
						);
					}
					?>
				</ul>

				<?= $paginationLinks; ?>

			<?php else: ?>
				<p class="no-result"><i><?= wfMsg('wikiasearch2-noresults') ?></i></p>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>
